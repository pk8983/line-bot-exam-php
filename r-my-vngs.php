<?php // callback.php

require "vendor/autoload.php";

$access_token = 'yFTYt7Fkd+vdapetkarW7GmU7ocMFRfAVEgjHgYozfza8hV0N9MPK8on4s7ekZmhLoPXwgaCaPOW6Lh/cd6kDM3fy9BISv3U8CWiUmiEM0yaddwhe2Sp3g4j5jqKiPSONi8dw5E5RpRQIfsj3FVw2QdB04t89/1O/w1cDnyilFU=';
$channelSecret = "d63194425ca914f580959b2d17c0fc15";
$idPush = 'U0e6fd4dbfdaf9d6114d836617c0c26a0';
$message = "PR ของท่านได้รับการอนุมัติ";//$_POST['message'];
	// Loop through each event

	

		$idPush = 'U0e6fd4dbfdaf9d6114d836617c0c26a0'
		$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
		$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);
		$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($message);
		$response = $bot->pushMessage($idPush, $textMessageBuilder);

		echo $response->getHTTPStatus() . ' ' . $response->getRawBody();


	

?>
