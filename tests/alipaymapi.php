<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>title </title>
</head>

<?php

require "TestCase.php";

use Alipay\MerchantApi\Client;

$alipay_config = require("alipay.mapi.config.php");


/**************************请求参数**************************/
function buildRequestParams()
{

    //支付类型
    $payment_type = "1";
    //必填，不能修改
    //服务器异步通知页面路径
    $notify_url = "http://125.85.102.74:8000/alipay.wap.create.direct.pay.by.user-PHP-UTF-8/notify_url.php";
    //需http://格式的完整路径，不能加?id=123这类自定义参数

    //页面跳转同步通知页面路径
    $return_url = "http:/125.85.102.74:8000/alipay.wap.create.direct.pay.by.user-PHP-UTF-8/return_url.php";
    //需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/

    //商户订单号
    $out_trade_no = '2015201145';
    //商户网站订单系统中唯一订单号，必填

    //订单名称
    $subject = '我怎么知道';
    //必填

    //付款金额
    $total_fee = "0.01";
    //必填

    //商品展示地址
    $show_url = 'http://www.baidu.com';
    //必填，需以http://开头的完整路径，例如：http://www.商户网址.com/myorder.html

    //订单描述
    $body = '描述';
    //选填

    /*	//超时时间
        $it_b_pay = $_POST['WIDit_b_pay'];
        //选填

        //钱包token
        $extern_token = $_POST['WIDextern_token'];
        //选填*/


    /************************************************************/

//构造要请求的参数数组，无需改动
    $parameter = array(
        "service" => "alipay.wap.create.direct.pay.by.user",
        "payment_type" => $payment_type,
        "notify_url" => $notify_url,
        "return_url" => $return_url,
        "out_trade_no" => $out_trade_no,
        "subject" => $subject,
        "total_fee" => $total_fee,
        "show_url" => $show_url,
        "body" => $body,
//		"it_b_pay" => $it_b_pay,
//		"extern_token" => $extern_token,
    );
    return $parameter;
}

//建立请求
$client = new Client($alipay_config);
//var_dump($client->alipay_config);

$parameter = $client->withDefaultParams( buildRequestParams() );
$html_text = $client->buildRequestForm($parameter, "get", "确认");
echo $html_text;
//var_dump( $client->buildRequestParaToString($parameter) );
//var_dump( $client->buildPaymentLink($parameter) );
?>
</body>
</html>