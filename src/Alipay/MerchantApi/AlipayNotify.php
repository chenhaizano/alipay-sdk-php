<?php
/**
 * Created by PhpStorm.
 * User: wu
 * Date: 2016/3/1
 * Time: 16:41
 */

namespace Alipay\MerchantApi;

require_once __DIR__.'/lib/alipay_notify.class.php';
require_once __DIR__.'/lib/alipay_md5.function.php';

class AlipayNotify extends \AlipayNotify
{

    static function defaultConfig (){
        return require( __DIR__.'/config/alipay.mapi.config.default.php' );
    }

    function __construct($alipay_config){
        $this->alipay_config = array_merge( static::defaultConfig(), $alipay_config );
        if (!array_key_exists('seller_id',$this->alipay_config)){
            $this->alipay_config['seller_id'] =  $this->alipay_config['partner'];
        }
    }
    
    /**
     * 获取返回时的签名验证结果
     * @param $para_temp 通知返回来的参数数组
     * @param $sign 返回的签名结果
     * @return 签名验证结果
     */
    function getSignVeryfy($para_temp, $sign) {
        //除去待签名参数数组中的空值和签名参数
        $para_filter = paraFilter($para_temp);

        //对待签名参数数组排序
        $para_sort = argSort($para_filter);

        //把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
        $prestr = createLinkstring($para_sort);

        $isSgin = false;
        switch (strtoupper(trim($this->alipay_config['sign_type']))) {
            case "RSA" :
                $isSgin = rsaVerify($prestr, trim($this->alipay_config['ali_public_key_path']), $sign);
                break;
            case "MD5" :
                $isSgin = md5Verify($prestr,$sign,$this->alipay_config['key']);
                break;
        }

        return $isSgin;
    }

}