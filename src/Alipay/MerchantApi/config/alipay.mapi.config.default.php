<?php
/* *
 * 配置文件
 * 版本：3.3
 * 日期：2012-07-19
 * 提示：如何获取安全校验码和合作身份者id
 * 1.用您的签约支付宝账号登录支付宝网站(www.alipay.com)
 * 2.点击“商家服务”(https://b.alipay.com/order/myorder.htm)
 * 3.点击“查询合作者身份(pid)”、“查询安全校验码(key)”
	
 * 安全校验码查看时，输入支付密码后，页面呈灰色的现象，怎么办？
 * 解决方法：
 * 1、检查浏览器配置，不让浏览器做弹框屏蔽设置
 * 2、更换浏览器或电脑，重新登录查询。
 */

//↓↓↓↓↓↓↓↓↓↓请在这里配置您的基本信息↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
//合作身份者id，以2088开头的16位纯数字
$alipay_config = [];
$alipay_config['partner'] = '2088';
//收款支付宝账号，一般情况下收款账号就是签约账号
//$alipay_config['seller_id']	= $alipay_config['partner'];

//商户的私钥（后缀是.pem）文件相对路径
$alipay_config['private_key_path'] = 'key/rsa_mapi_private_key.pem';

//支付宝公钥（后缀是.pem）文件相对路径
$alipay_config['ali_public_key_path'] = __DIR__.'/key/alipay_mapi_rsa_public_key.pem';

//md5签名才需要
$alipay_config['key'] = '';
//↑↑↑↑↑↑↑↑↑↑请在这里配置您的基本信息↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑

//签名方式不需修改支持两种，如果移动支付只能使用RSA
$alipay_config['sign_type'] = 'RSA';

//字符编码格式 目前支持 gbk 或 utf-8
$alipay_config['input_charset'] = 'utf-8';

//ca证书路径地址，用于curl中ssl校验
//请保证cacert.pem文件在当前文件夹目录中
$alipay_config['cacert'] = __DIR__ . '/key/cacert.pem';

//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
$alipay_config['transport'] = 'https';

return $alipay_config;
