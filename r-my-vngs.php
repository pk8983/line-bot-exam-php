<?php // callback.php

require "vendor/autoload.php";
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');

$access_token = 'yFTYt7Fkd+vdapetkarW7GmU7ocMFRfAVEgjHgYozfza8hV0N9MPK8on4s7ekZmhLoPXwgaCaPOW6Lh/cd6kDM3fy9BISv3U8CWiUmiEM0yaddwhe2Sp3g4j5jqKiPSONi8dw5E5RpRQIfsj3FVw2QdB04t89/1O/w1cDnyilFU=';
$channelSecret = "d63194425ca914f580959b2d17c0fc15";
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new  \LINE\LINEBot($httpClient, array('channelSecret' => $channelSecret));
	$user_id = "U0e6fd4dbfdaf9d6114d836617c0c26a0";//$_POST['user_id'];
 	$message = "PR ของท่านได้รับการอนุมัติ";//$_POST['message'];
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
			// Get text sent
			$text = $user_id;
			// Get replyToken
			$replyToken = $event['replyToken'];

			


			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $message,
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		
	}

?>
