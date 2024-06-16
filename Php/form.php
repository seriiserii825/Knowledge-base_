<?php 
//$_POST = json_decode(file_get_contents("php://input"), true);

<?php
$_POST = json_decode(file_get_contents("php://input"), true);
$name  = $_POST['name'];
$phone = $_POST['phone'];

//$to      = 'seriiburduja@mail.ru';
//$subject = 'the subject';
$message = 'message: '.$name.' phone: '.$phone;
//echo var_dump($message);
////$headers = 'From: webmaster@example.com' . "\r\n" . 'Reply-To: webmaster@example.com' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
mail( $to, $subject, $message);
