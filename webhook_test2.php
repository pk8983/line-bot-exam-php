<?php
$access_token = "DW8c1hq6M+RQ9/paVgF5sdpLmAYH1QDM14rCwiMXtse1t5JnXKSmc+F5ecquehzuXsbKO7uEGXsXgI/B+pvF7uUVkc2FB5RRf0Xdd5lQGhthiTe2b5Pin5EQjQfxVgKrJf2IJtPQKRJtm3PCkuo34AdB04t89/1O/w1cDnyilFU=";

$content = file_get_contents('php://input');
$arrayJson = json_decode($content, true);

    $arrayHeader = array();
    $arrayHeader[] = "Content-Type: application/json";
    $arrayHeader[] = "Authorization: Bearer {$access_token}";
    
    //รับข้อความจากผู้ใช้
    $message = $arrayJson['events'][0]['message']['text'];
    #ตัวอย่าง Message Type "Text"
    if($message == "สวัสดี"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "สวัสดีจ้าาา";
        
        $textMessageBuilder = new TextMessageBuilder(json_encode($events));
        replyMsg($arrayHeader,$textMessageBuilder);              
    }
  
function replyMsg($arrayHeader,$arrayPostData){
        $strUrl = "https://api.line.me/v2/bot/message/reply";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$strUrl);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);    
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($arrayPostData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close ($ch);
    }
   exit;
?>
