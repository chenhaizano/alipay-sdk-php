aliay-sdk-php
=============

a modification of alipay php-sdk,icludes both openapi and mapi

Table of contents
-----------------
* [Modifications](#modifications)
* [Installation](#installation)
* [Configuration](#configuration)
* [Examples](#examples)
* [License](#license)

modifications:
--------------
### mapi
* add md5 sign/verfy although not often used
* add default configuration and alipay mapi public key

### openapi
* add namespaces
* remove lotusphp_runtime requirement
* add default configuration and alipay openapi public key


Installation
------------

using composer:

```shell
composer require fishlab/aliay-sdk-php
```


Configuration
-------------
### mapi
```php
<?php

$alipay_config =[];
/// --- required ---
$alipay_config['partner'] = '2088xxx';

// requiref if sign_type is RSA
$alipay_config['private_key_path'] = 'key/mapi_rsa_private_key.pem';

// required if sign_type is MD5
// $alipay_config['key'] = 'your secret';

/// --- optional ----

// usually,seller_id equals partner
// $alipay_config['seller_id'] = $alipay_config['partner'];
// $alipay_config['ali_public_key_path']= 'key/alipay_public_key.pem';

// sign type,defualt is RSA
// $alipay_config['sign_type'] = 'RSA';

// support gbk or utf-8,default 'utf-8'
// $alipay_config['input_charset'] = 'utf-8';

// transfer protocol
// $alipay_config['transport'] = 'https';

```
### openapi

```php
<?php

$config = [
		'alipay_public_key_file' => __DIR__. "/key/alipay_openapi_rsa_public_key.pem",
		'merchant_private_key_file' => "you/openapi_rsa_private_key.pem",
		'charset' => "UTF-8",
		'gatewayUrl' => "https://openapi.alipay.com/gateway.do",
		'app_id' => "2015123456000000"
];
```

Examples
--------
see tests/*.php

License
-------
MIT
