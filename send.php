<?php

if($_POST['user_name']!="" && $_POST['user_phone']!="" && $_POST['comment']!="")
{
		$name = $_POST['user_name'];
		$phone = $_POST['user_phone'];
		$comment = $_POST['comment'];
}
else{
	header('Location:index.html');
	exit;
}

function getIp()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

$token = "......."; // Введите сюда свой токен из @BotFather
$chat_id = "....."; // Введите свой telegram-id

$arr = array(
   'Имя: '=> $name,
   'IP: ' => getIp(),
   'Почта: '=> $phone,
   'Вопрос: '=> $comment,
);

foreach ($arr as $key => $value) {
	$txt .= "<b>".$key."</b> ".$value."%0A";
}

$sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}", "r");

if($sendToTelegram)
{
   echo '<h1 class="success">Спасибо за вопрос!</h1>';
   return true;

}else{
   echo '<h1>Подождите минутку, не отправляйте много запросов.</h1>';
}

?>
