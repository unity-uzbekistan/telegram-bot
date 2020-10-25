<?php
$path = "https://api.telegram.org/bot1235771809:AAFOeA8DfjpAtDRZTBCZ78Lum4UnuzCsofs";
$update = json_decode(file_get_contents("php://input"), TRUE);

$chatId = $update["message"]["chat"]["id"];
$message = $update["message"]["text"];

function sendText($response,$chatId) {
$path = $GLOBALS['path'];
$response = urlencode($response);
file_get_contents($path."/sendmessage?chat_id=".$chatId."&text=".$response);	
}

function sendButton($response,$chatId,$buttons){
	$path = $GLOBALS['path'];
	$buttons = urlencode($buttons);
	$response = urlencode($response);
	file_get_contents($path."/sendmessage?chat_id=".$chatId."&text=".$response."&reply_markup=".$buttons);
}
function textHandler($chatId,$message){
	$response = "";
	sendResponse($response,$chatId);
}
function buttonHandler($chatId,$message) {
	$response = "test buttons";
	$keyboard = [
    'inline_keyboard' => [
        [
            ['text' => 'English', 'callback_data' => 'en'],
			['text' => 'O\'zbekcha', 'callback_data' => 'uz'],
			['text' => 'Русский', 'callback_data' => 'ru']
        ]
	]
];
	$buttons = json_encode($keyboard);
	sendButton($response,$chatId,$buttons);
}

buttonHandler($chatId,$message);
if(isset($update['callback_query'])) {
	$callback_query = $update['callback_query']['data'];
	$chatId = $update['callback_query']['from']['id'];
	$response = 'Tanlangan til: '.$callback_query;
	sendText($response,$chatId);
}
?>