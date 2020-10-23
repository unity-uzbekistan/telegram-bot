<?php
$path = "https://api.telegram.org/bot1235771809:AAFOeA8DfjpAtDRZTBCZ78Lum4UnuzCsofs";
$update = json_decode(file_get_contents("php://input"), TRUE);


$chatId = $update["message"]["chat"]["id"];
$message = $update["message"]["text"];

$commands = array(
	"/start",
	"",
	"/",
	"/",
	"/",
	"/",
	"/",
	"/",
	"/",
	"/",
);

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
            ['text' => 'demo', 'callback_data' => 'someString']
        ]
	]
];
	$buttons = json_encode($keyboard);
	sendButton($response,$chatId,$buttons);
}

buttonHandler($chatId,$message);
?>