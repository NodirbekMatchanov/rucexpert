<?php


namespace frontend\controllers;

use common\models\Hotels;
use common\models\Invoice;
use common\models\User;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\BadRequestHttpException;
use yii\base\InvalidParamException;

class PaymentController extends Controller
{
    public function actionInvoice()
    {
        $model = new Invoice();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            /** @var \robokassa\Merchant $merchant */
            $merchant = Yii::$app->get('robokassa');
            return $merchant->payment($model->summ, $model->id, 'Пополнение счета', null, \Yii::$app->user->identity->email);
        } else {
            var_dump($model->errors);
            die();
            return $this->redirect('/personal-area/index');
        }
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'result' => [
                'class' => '\robokassa\ResultAction',
                'callback' => [$this, 'resultCallback'],
            ],
            'success' => [
                'class' => '\robokassa\SuccessAction',
                'callback' => [$this, 'successCallback'],
            ],
            'fail' => [
                'class' => '\robokassa\FailAction',
                'callback' => [$this, 'failCallback'],
            ],
        ];
    }

    /**
     * Callback.
     * @param \robokassa\Merchant $merchant merchant.
     * @param integer $nInvId invoice ID.
     * @param float $nOutSum sum.
     * @param array $shp user attributes.
     */
    public function successCallback($merchant, $nInvId, $nOutSum, $shp)
    {
        $model = $this->loadModel($nInvId);
        $model->updateAttributes(['status' => Invoice::STATUS_ACCEPTED]);
        $user = User::findOne($model->user_id);
        $hotel = Hotels::findOne($user->hotel_id);
        $hotel->balance += $model->summ;
        $hotel->save();
        Yii::$app->session->setFlash('success', 'Счет пополнен!');
        return $this->redirect('index');
    }

    public function resultCallback($merchant, $nInvId, $nOutSum, $shp)
    {
        $this->loadModel($nInvId)->updateAttributes(['status' => Invoice::STATUS_SUCCESS]);
        return 'OK' . $nInvId;
    }

    public function failCallback($merchant, $nInvId, $nOutSum, $shp)
    {
        $model = $this->loadModel($nInvId);
        if ($model->status == Invoice::STATUS_PENDING) {
            $model->updateAttributes(['status' => Invoice::STATUS_FAIL]);
            Yii::$app->session->setFlash('error', 'Счет пополнен!');
            return $this->redirect('index');
        } else {
            return 'Status has not changed';
        }
    }

    /**
     * @param integer $id
     * @return Invoice
     * @throws \yii\web\BadRequestHttpException
     */
    protected function loadModel($id)
    {
        $model = Invoice::find($id);
        if ($model === null) {
            throw new BadRequestHttpException;
        }
        return $model;
    }
}