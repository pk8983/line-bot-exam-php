<?php // callback.php

require "vendor/autoload.php";
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');

$access_token = 'DW8c1hq6M+RQ9/paVgF5sdpLmAYH1QDM14rCwiMXtse1t5JnXKSmc+F5ecquehzuXsbKO7uEGXsXgI/B+pvF7uUVkc2FB5RRf0Xdd5lQGhthiTe2b5Pin5EQjQfxVgKrJf2IJtPQKRJtm3PCkuo34AdB04t89/1O/w1cDnyilFU=
';
$channelSecret = "2ec65e2ccf14cdb95e59c30c90640cbb";
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new  \LINE\LINEBot($httpClient, array('channelSecret' => $channelSecret));

if (!is_null($events['events'])) {
	echo "test";
}
echo "OK";
?>
