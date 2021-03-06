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

if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['source']['userId'];
			// Get replyToken
			$replyToken = $event['replyToken'];

			
      		//อ่าน user Id displaname ของ line แต่ละน
      	

			$res = $bot->getProfile($text);
			if ($res->isSucceeded()) {
			    $profile = $res->getJSONDecodedBody();
			    $displayName = $profile['displayName'];
			}else{
				$displayName = "อ่านชื่อไม่ได้1";
			}

			$data_send_vngs = array(
		            'user_id' => $event['source']['userId'],
		            'line_name' => $displayName,
		            'message' => $event['message']['text'],
		        ); 

			 
			   $ch_vngs = curl_init();
			   curl_setopt($ch_vngs, CURLOPT_URL, 'https://www.my-vngs.com/main/line_document/r-line-bot.php');
			   curl_setopt($ch_vngs, CURLOPT_POSTFIELDS, $data_send_vngs);
			   curl_setopt($ch_vngs, CURLOPT_TIMEOUT, 86400); // 1 Day Timeout
			   curl_setopt($ch_vngs, CURLOPT_CONNECTTIMEOUT, 60000);
			   curl_setopt($ch_vngs, CURLOPT_RETURNTRANSFER, true);
			   curl_setopt($ch_vngs, CURLOPT_REFERER, $_SERVER['HTTP_HOST']);
			   curl_setopt( $ch_vngs, CURLOPT_SSL_VERIFYPEER, false );

			   $response = curl_exec($ch_vngs);
			   curl_close($ch_vngs);

			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $response,
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
	}
}
echo "OK";
?>
