<?php 
    
//Connecting Line
$API_URL = 'https://api.line.me/v2/bot/message';
$Access_Token = 'SDMQrDXZbgNGwqGS+x1VR/cDtCexev6WfDMqIWKy8jGqIOO17SEGCeXztLKHGwjBe5Q5qkRKi8kUg2TVDnD0YHnqT6vwC1z10zXe4DyXWIupUabIZySwBb0duOx3uKDoOO64rn/BWA7mr++oDJIl4AdB04t89/1O/w1cDnyilFU='; 
$Channel_Secret = 'f1100308869568bc4513567298a9d2f5';

//Header
$Post_header = array('Content-Type: application/json', 'Authorization: Bearer '. $Access_Token);

//Get request content
$Request = file_get_contents('php://input');

//Decode Json to Array
$Request_Arr = json_decode($Request,true);

if(sizeof($Request_Arr['events']) > 0)
{
    foreach($Request_Arr['events'] as $events)
    {
        $reply_message = '';
        $reply_token = $event['replyToken'];


        $data = [
            'replyToken' => $reply_token,
            'messages' => [['type' => 'text', 'text' => json_encode($request_array)]]
        ];
        $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);

        $send_result = send_reply_message($API_URL.'/reply', $Post_header, $post_body);

        echo "Result: ".$send_result."\r\n";
    }
}

function send_reply_message($url, $post_header, $post_body)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $post_header);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_body);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $result = curl_exec($ch);
    curl_close($ch);

    return $result;
}

?> 
