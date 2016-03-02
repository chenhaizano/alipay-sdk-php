<?php


require "TestCase.php";
require_once 'F2fpay.php';
$f2fpay = new F2fpay();
$out_trade_no = '2014112200';
$auth_code = '281095684896740335';
$total_amount = '0.01';
$subject = 'a test';
$response = $f2fpay->barpay($out_trade_no, $auth_code, $total_amount, $subject);
print_r($response);
return;