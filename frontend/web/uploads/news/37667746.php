<?php
/**
 * Created by PhpStorm.
 * User: Temurbek
 * Date: 05.09.18
 * Time: 13:32
 */

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers');

include_once(dirname(__FILE__) . '/../../_lib/init.php');
HAmo::initAmoApi();

ini_set('error_log', __DIR__ . '/php_errors_' . HFile::getFileNameByPath($_SERVER['SCRIPT_NAME'], true) . '.log');
ini_set('log_errors', 1);

HU::logSetup(dirname(__FILE__) . '/log/' . HFile::getFileNameByPath(__FILE__, true) . '.log');

HU::log("---START---");
$clid = HU::request('clid');
$login = HU::request('login');
$password = HU::request('api_key');
HU::log($_SERVER['SERVER_NAME']);
$domain = ($_SERVER['SERVER_NAME'] == 'yadro.introvert.bz') ? 'introvert.amocrm.ru' : 'prod.amocrm.ru';

if (!service_Check_AmoCRM($domain, $login, $password)) {
    HU::log('Данный запрос не приходять из амо');
    HU::log('---END---');
    return;
}
// если CLID 0 или 1 то должны быть так же отработаны как пустое значение
if ($clid > 1) {
    SystemClient::cleanClient();
    $_GET['key'] = key_Get($clid);

    // получаем данные о клиенте
    $amoData = getServiceData('amocrm', $clid);

    // парсим доступы
    $domain = $amoData['domain'];
    $login = $amoData['login'];
    $password = $amoData['password'];
    $subdomain = explode('.', $domain)[0];

    $client = \Yadro\Models\YadroUser::getByClid($clid);
    $answer = [
        'clid' => $clid,
        'acc_id' => $client->amo_id,
        'type_client' => getClientTypeDescription($client->type)
    ];
    //Если данные про клиента нет в БД то его получаем из АМО
    if (empty($client->account))
        $client->account = amocrm_GetInfo();

    $answer['name_tariff'] = '?';

    // дата актуализации данных по лицензиям
    $answer['date_update'] = '?';

    $answer['close_date'] = '?';
    $answer['tariff_users'] = '? из ?';
    $answer['status'] = '?';
    $answer['domain'] = '?';

    $tariff = $client->getBillingInfo();

    if (!empty($tariff)) {
        $answer['name_tariff'] = $tariff['tariff_name'];
        $answer['domain'] = $tariff['domain'];
        // у некоторих клиенов в поле дата слэши экранированы уберем "\"
        $tariff['real_term_end_date'] = str_replace("\/", "/", $tariff['real_term_end_date']);
        if (!empty($client->account['date_format'])) {
            $date_format = $client->account['date_format'];
            // если формат d/m/Y то заменит "/" на "." а то при перевод на int получается не корректный формат
            if ($date_format == 'd/m/Y') {
                $tariff['real_term_end_date'] = str_replace("/", ".", $tariff['real_term_end_date']);
            }
        }
        $answer['close_date'] = strtotime($tariff['real_term_end_date']);
        $answer['date_update'] = $tariff['date_update'];
        $answer['tariff_users'] = count($client->account['users']) . ' из ' . $tariff['count_user'];
        if ($tariff['is_trial']) {
            $answer['status'] = 'Триал';
        } else {
            $now = time();
            $endClose = strtotime($tariff['real_term_end_date']);
            $answer['status'] = ($now > $endClose) ? 'Не активен' : 'Активен';
        }
    }

    // город
    $answer['city'] = $client->getClientInfoWithGeo()['intr_yadro_city'];

    // дата последней активности ядра
    $answer['last_yadro_activity'] = 0;
    $widgetInfo = json_decode($client->widget_info, true);
    if (isset($widgetInfo['time'])) {
        $answer['last_yadro_activity'] = $widgetInfo['time'];
    }

    $answer['timezone'] = '?';
    $answer['users'] = [];
    if (isset($client->account['users'])) {
        $users = $client->account['users'];
        if (isset($client->account['timezone'])) {
            $timezone = $client->account['timezone'];
            $timestamp = time();
            $date = new DateTime("now", new DateTimeZone($timezone));
            $date->setTimestamp($timestamp);
            $answer['timezone'] = $date->format('H:i') . ' (GMT ' . $client->account['timezoneoffset'] . ')';
        }

        // получаем онлайн-пользователей
        $onlineUsers = getOnlineUsers();
        $idOnlineUsers = [];
        // получаем амоид онлайн-пользователей
        foreach ($onlineUsers as $onlineUser) {
            $idOnlineUsers[] = $onlineUser['amoid'];
        }
        foreach ($users as $user) {
            $userInfo = [
                'name' => $user['name'],
                'phone' => empty($user['phone_number']) ? '—' : $user['phone_number'],
                'email' => $user['login'],
                'id' => $user['id'],
                'online' => in_array($user['id'], $idOnlineUsers),
                'isAdmin' => $user['is_admin'] === 'Y'
            ];

            if ($user['login'] === $login) {
                $mainAdmin[] = $userInfo;
            } else {
                if ($user['is_admin'] === 'Y') {
                    $admins[] = $userInfo;
                } else {
                    $notAdmins[] = $userInfo;
                }
            }
        }

        $answer['users'] = array_merge($mainAdmin ?? [], $admins ?? [], $notAdmins ?? []);
    }

    $widgets = getWidgets();
    $answer['widgets'] = [];
    foreach ($widgets as $widget) {
        // если виджет виден в маркете, то берем его
        if ($widget['marketplace_visible'] !== '0') {
            $demoDate = $widget['demo_date'] ?? '_';
            $subscriptionDate = $widget['subscription_date'] ?? '_';

            $answer['widgets'][] = [
                'name' => $widget['name'],
                'demo' => $demoDate,
                'subscription' => $subscriptionDate
            ];
        }
    }

    if (isset($domain) && isset($login) && isset($password)) {
        // получаем список интеграций
        $integrations = getIntegrations($domain, $login, $password);

        // если при получении списка интеграций произошла ошибка (поле status === false),
        // то выходим с ошибкой, что у нас нет доступов;
        if (!$integrations['status']) {
            $answer['yadro_status'] = 'undefined';
            $answer['yadro_status_text'] = 'Ошибка авторизации';
        } else {
            // проверяем состояние ядра
            list($yadroStatus, $yadroStatusText) = getYadroStatusByWidgetsListMethod($integrations['integrations'], $subdomain);

            // если статус виджета ядра == 'enabled',
            // то забираем на фронт статус 'enabled' и текст статуса 'Установлено, включено'
            // статус используется в качестве флага отрисовки кнопки 'Установить и включить Ядро'
            // текст статуса отображается в поле 'Статус Ядра'
            if ($yadroStatus === 'enabled') {
                $answer['yadro_status'] = $yadroStatus;
                $answer['yadro_status_text'] = $yadroStatusText;
            } else {
                HU::log('Не получилось обнаружить ядро через запрос /widgets/list');
                HU::log('Попробуем обнаружить ядро через запрос /settings/dev');

                // получаем приватные виджеты
                $widgets = getPrivateWidgets($domain, $login, $password);

                // в этом случае помимо статуса и текста статуса забираем id и код виджета ядра 
                // они нужны для включения виджета с фронта путем запроса, отправляющегося при нажатии на кнопку 'Установить и включить ядро'
                list($answer['yadro_status'], $answer['yadro_status_text'], $answer['yadro_id'], $answer['yadro_code']) = getYadroInfoBySettingsDevMethod($widgets, $subdomain);
            }
        }
    } else {
        $answer['yadro_status'] = 'undefined';
        $answer['yadro_status_text'] = 'Ошибка авторизации';
    }

    HU::log($answer);
    echo json_encode($answer);

} else {
    $answer = [];
    $hiddenTypes = [2, 3, 4, 5, 6, 8, 10];
    $clientTypes = getClientTypes();
    foreach ($clientTypes as $clientType) {
        if (!in_array($clientType['id'], $hiddenTypes)) {
            $answer['client_types'][] = [
                'id' => $clientType['id'],
                'option' => $clientType['description']
            ];
        }
    }
    HU::log($answer);
    echo json_encode($answer);
}

// функция получения списка интеграций
function getIntegrations($domain, $login, $password)
{
    $httpClient = new GuzzleHttp\Client(['http_errors' => false]);

    $response = $httpClient->request('POST', 'https://' . $domain . '/ajax/widgets/list/?USER_LOGIN=' . $login . '&USER_HASH=' . $password, [
        'headers' => [
            'X-Requested-With' => 'XMLHttpRequest',
        ],
    ])->getBody();

    $response = json_decode($response, 1);

    if (isset($response['widgets'])) {
        HU::log('Список виджетов (/widgets/list)');
        HU::log($response['widgets']);

        return [
            'integrations' => $response['widgets'],
            'status' => true
        ];
    } else if (isset($response['error'])) {
        HU::log('Произошла ошибка');
        HU::log($response['error']);

        return [
            'integrations' => [],
            'status' => false
        ];
    } else {
        HU::log('Что-то странное - виджетов нет!');
        HU::log($response);

        return [
            'integrations' => [],
            'status' => true
        ];
    }
}

// функция получения статуса виджета ядра (ядро ищется среди виджетов, полученных методом /widgets/list)
function getYadroStatusByWidgetsListMethod($widgets, $subdomain)
{
    foreach ($widgets as $widgetCode => $widget) {
        if (strpos($widgetCode, 'yadro_' . $subdomain) === 0) {
            if ($widget['active'] === 'Y') {
                return [
                    'enabled',
                    'Установлено, включено'
                ];
            }
        }
    }

    return [
        'undefined',
        'Неизвестно'
    ];
}

// функция получения статуса виджета ядра (ядро ищется среди виджетов, полученных методом /settings/dev)
function getYadroInfoBySettingsDevMethod($widgets, $subdomain)
{
    // если нашли виджет ядра, то считаем, что он выключен (возвращает на фронт статус, текст статуса, id и код виджета ядра, чтоб его включить можно было через запрос)
    foreach ($widgets as $widget) {
        if (strpos($widget['code'], 'yadro_' . $subdomain) === 0) {
            return [
                'disabled',
                'Установлено, выключено',
                $widget['id'],
                $widget['code']
            ];
        }
    }

    // иначе, считаем, что виджета ядра на аккаунте нет (возвращаем на фронт статус и текст статуса - id и код виджета не нужен, потому что мы будем устанавливать виджет с нуля)
    return [
        'non-installed',
        'Не установлено',
        null,
        null
    ];
}

// функция получения приватных виджетов (раздел api)
function getPrivateWidgets($domain, $login, $password)
{
    $httpClient = new GuzzleHttp\Client(['http_errors' => false]);

    $response = $httpClient->request('GET', 'https://' . $domain . '/ajax/settings/dev/?USER_LOGIN=' . $login . '&USER_HASH=' . $password, [
        'headers' => [
            'X-Requested-With' => 'XMLHttpRequest',
        ],
    ])->getBody();

    $response = json_decode($response, 1);

    if (isset($response['response']) &&
        isset($response['response']['widgets']) &&
        isset($response['response']['widgets']['items'])) {
        HU::log('Список приватных виджетов (/settings/dev)');
        HU::log($response['response']['widgets']['items']);

        return $response['response']['widgets']['items'];
    } else {
        HU::log('Что-то странное - приватных виджетов нет!');
        HU::log($response);

        return [];
    }
}