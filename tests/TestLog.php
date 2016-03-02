<?php
namespace Tests;

require "TestCase.php";
/**
 * Created by PhpStorm.
 * User: wu
 * Date: 2016/2/29
 * Time: 15:18
 */

use Alipay\OpenApi\Client;

echo "test log?";
$client  = new Client([]);
$client->logCommunicationError('what','asd','404','I don\'t know');
