<?php
/**
 * Created by PhpStorm.
 * User: wu
 * Date: 2016/3/1
 * Time: 16:37
 */

namespace Tests;

require_once  "../vendor/autoload.php";
error_reporting(E_ALL ^ E_NOTICE);
if( ! ini_get('date.timezone') )
{
    date_default_timezone_set('GMT');
}

class TestCase
{

}