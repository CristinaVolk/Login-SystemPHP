<?php 
$to = 'kristinavolk4@tut.by';
$subject ='Hi';
$message ='Hi, this is a test email';
$headers = 'From: volkkristina314@gmail.com';

if (mail($to, $subject, $message, $headers))
echo 'Email sent successfully';
else 
echo 'Failed';

?>