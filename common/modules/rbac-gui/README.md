RBAC Manager for Yii 2
======================
GUI manager for RABC (Role Base Access Control) Yii2. Easy to manage authorization of user :smile:.

[![Latest Unstable Version](../../../backend/web/index.phpmdmsoft/yii2-admin/v/unstable)](../../../backend/web/index.phpackages/mdmsoft/yii2-admin)
[![Total Downloads](../../../backend/web/index.phpmdmsoft/yii2-admin/downloads.png)](../../../backend/web/index.phpackages/mdmsoft/yii2-admin)
[![Daily Downloads](../../../backend/web/index.phpmdmsoft/yii2-admin/d/daily)](../../../backend/web/index.phpackages/mdmsoft/yii2-admin)
[![License](../../../backend/web/index.phpmdmsoft/yii2-admin/license)](../../../backend/web/index.phpackages/mdmsoft/yii2-admin)
[![Reference Status](../../../backend/web/index.phpcom/php/mdmsoft:yii2-admin/reference_badge.svg)](../../../backend/web/index.phpcom/php/mdmsoft:yii2-admin/references)
[![Build Status](../../../backend/web/index.phptravis/mdmsoft/yii2-admin.svg)](../../../backend/web/index.phpmsoft/yii2-admin)
[![Dependency Status](../../../backend/web/index.phpcom/php/mdmsoft:yii2-admin/dev-master/badge.png)](../../../backend/web/index.phpcom/php/mdmsoft:yii2-admin/dev-master)
[![Scrutinizer Code Quality](../../../backend/web/index.phpcom/g/mdmsoft/yii2-admin/badges/quality-score.png?b=master)](../../../backend/web/index.phpcom/g/mdmsoft/yii2-admin/?branch=master)
[![Code Climate](../../../backend/web/index.phpcodeclimate/github/mdmsoft/yii2-admin.svg)](../../../backend/web/index.php/github/mdmsoft/yii2-admin)

Documentation
-------------
> **Important: If you install version 3.x, please see [this readme](../../../backend/web/index.phpoft/yii2-admin/blob/3.master/README.md#upgrade-from-2x).**


- [Change Log](CHANGELOG.md).
- [Authorization Guide](../../../backend/web/index.php.com/doc-2.0/guide-security-authorization.html). Important, read this first before you continue.
- [Basic Configuration](../../../backend/web/index.phpn.md)
- [Basic Usage](../../../backend/web/index.phpmd).
- [User Management](../../../backend/web/index.phpent.md).
- [Using Menu](../../../backend/web/index.phpd).
- [Api](../../../backend/web/index.phpio/yii2-admin/index.html).

Installation
------------

### Install With Composer

The preferred way to install this extension is through [composer](../../../backend/web/index.phpdownload/).

Either run

```
php composer.phar require mdmsoft/yii2-admin "~1.0"
or
php composer.phar require mdmsoft/yii2-admin "~2.0"
```

or for the dev-master

```
php composer.phar require mdmsoft/yii2-admin "2.x-dev"
```

Or, you may add

```
"mdmsoft/yii2-admin": "~2.0"
```

to the require section of your `composer.json` file and execute `php composer.phar update`.

### Install From the Archive

Download the latest release from here [releases](../../../backend/web/index.phpoft/yii2-admin/releases), then extract it to your project.
In your application config, add the path alias for this extension.

```php
return [
    ...
    'aliases' => [
        '@mdm/admin' => 'path/to/your/extracted',
        // for example: '@mdm/admin' => '@app/extensions/mdm/yii2-admin-2.0.0',
        ...
    ]
];
```

[**More...**](../../../backend/web/index.phpn.md)

[screenshots](https://goo.gl/r8RizT)
