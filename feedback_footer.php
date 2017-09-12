<?php

/**
 * @author Alex
 * @copyright 2015
 */
 

	//Если форма отправлена
$kuda='freellproject@gmail.com';//адрес нашей почты
$zagolovok='From: FreelProJect.com';
$headers='Content-type: text; charset="utf-8"';

if (isset($_POST['btnsend'])){
    
    
    if(isset($_FILES['files']))
            {
                if($_FILES['files']['error'] == 0)
                {
                    $mail->AddAttachment($_FILES['files']['tmp_name'],$_FILES['files']['name']);
                }
            }
	//если существует переменная, значит начнем получать информацию из формы
	$fio=$_POST['fullname'];
	$email=$_POST['email'];
	$text=$_POST['message'];

	$messages=$text."\n".$email."\n".$fio;

	if (mail($kuda,$zagolovok,$messages,$headers)){ echo "<script>alert('Ваше сообщение отправлено!');
location.href='http://freepj.890m.com';</script>";}
	
	}










?>