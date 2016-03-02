<?php
namespace Alipay\MerchantApi;
/**
 * Created by PhpStorm.
 * User: wu
 * Date: 2016/3/1
 * Time: 16:14
 */
require_once __DIR__.'/lib/alipay_core.function.php';
require_once __DIR__.'/lib/alipay_submit.class.php';
require_once __DIR__.'/lib/alipay_md5.function.php';


class Client extends \AlipaySubmit
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
     * 生成签名结果 添加MD5校验
     * @param $para_sort 已排序要签名的数组
     * return 签名结果字符串
     */
    function buildRequestMysign($para_sort) {
        //把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
        $prestr = createLinkstring($para_sort);

        $mysign = "";
        switch (strtoupper(trim($this->alipay_config['sign_type']))) {
            case "RSA" :
                $mysign = rsaSign($prestr, $this->alipay_config['private_key_path']);
                break;
            case 'MD5':
                $mysign = md5Sign($prestr, $this->alipay_config['key']);
                break;
        }

        return $mysign;
    }

    public function withDefaultParams($customParams=null){
        $parameter = array(
            "partner" => trim($this->alipay_config['partner']),
            "seller_id" => trim($this->alipay_config['seller_id']),
            "_input_charset" => trim(strtolower($this->alipay_config['input_charset']))
        );

        if ( array_key_exists('notify_url',$this->alipay_config)){
            $parameter["notify_url"] = $this->alipay_config['notify_url'];
        }
        if ( array_key_exists('return_url',$this->alipay_config)){
            $parameter["return_url"] = $this->alipay_config['return_url'];
        }
        if ($customParams){
            return array_merge($parameter,$customParams);
        }else {
            return $parameter;
        }
    }

    public function buildPaymentLink($para_temp){
		return $this->alipay_gateway_new . $this->buildRequestParaToString($para_temp);
	}

    public function buildPaymentParam($para_temp){
		return $this->buildRequestParaToString($para_temp);
	}


}