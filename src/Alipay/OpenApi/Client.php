<?php

namespace Alipay\OpenApi;


class Client extends AopClient{
	var $logger;
	static function defaultConfig(){
		return require (__DIR__.'/config/alipay.openapi.config.default.php');
	}

	public function __construct($config,$logger=null){
		$config = array_merge(static::defaultConfig(),$config);
		$this->gatewayUrl = $config ['gatewayUrl'];
		$this->appId = $config ['app_id'];
		$this->rsaPrivateKeyFilePath = $config ['merchant_private_key_file'];
		$this->alipayPublicKey = $config['alipay_public_key_file'];
//		$this->apiVersion = "1.0";
		$this->logger = $logger;
	}

	public function logCommunicationError($apiName, $requestUrl, $errorCode, $responseTxt) {
		$localIp = isset ($_SERVER["SERVER_ADDR"]) ? $_SERVER["SERVER_ADDR"] : "CLI";
//		$logger = new LtLogger;
//		$logger->conf["log_file"] = rtrim(AOP_SDK_WORK_DIR, '\\/') . '/' . "logs/aop_comm_err_" . $this->appId . "_" . date("Y-m-d") . ".log";
//		$logger->conf["separator"] = "^_^";
		$logData = array(
			date("Y-m-d H:i:s"),
			$apiName,
			$this->appId,
			$localIp,
			PHP_OS,
			$this->alipaySdkVersion,
			$requestUrl,
			$errorCode,
			str_replace("\n", "", $responseTxt)
		);
//		$logger->log($logData);
		if ($this->logger){
			$this->logger->log($logData);
		}else {
			print_r($logData);
		}
	}


}