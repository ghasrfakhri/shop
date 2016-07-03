<?php

require './includes/init.php';


$soapclient = new SoapClient("https://sep.shaparak.ir/payments/referencepayment.asmx?WSDL");
var_dump($_POST);
$RefNum = $_POST['RefNum'];



$res = $soapclient->verifyTransaction($RefNum, 10002741);

var_dump($res);
