<?php
if (isset ($_POST['txtemail'])) {
  $to = "freellproject@gmail.com"; 
  $from = $_POST['txtemail'];
$txtphone = $_POST['txtphone'];
  $subject = "Предложение о работе. Заполнена контактная форма с ".$_SERVER['HTTP_REFERER'];
  $message = "Имя отправителя: ".$_POST['txtname']."\n Email: ".$from. "\nТелефон: ".$txtphone."\nСообщение: ".$_POST['message']."\nIP адресс отправителя: ".$_SERVER['REMOTE_ADDR'];
  $boundary = md5(date('r', time()));
  $filesize = '';
  $headers = "MIME-Version: 1.0\r\n";
  $headers .= "From: " . $from . "\r\n";
  $headers .= "Reply-To: " . $from . "\r\n";
  $headers .= "Content-Type: multipart/mixed;charset=\"utf-8\"; boundary=\"$boundary\"\r\n";
$message="
Content-Type: multipart/alternative; boundary=\"$boundary\"

--$boundary
Content-Type: text/plain; charset=\"utf-8\"
Content-Transfer-Encoding: quoted-printable

$message";
  for($i=0;$i<count($_FILES['file']['name']);$i++) {
     if(is_uploaded_file($_FILES['file']['tmp_name'][$i])) {
         $attachment = chunk_split(base64_encode(file_get_contents($_FILES['file']['tmp_name'][$i])));
         $filename = $_FILES['file']['name'][$i];
         $filetype = $_FILES['file']['type'][$i];
         $filesize += $_FILES['file']['size'][$i];
         $message.="

--$boundary
Content-Type: \"$filetype\"; name=\"$filename\"
Content-Transfer-Encoding: base64
Content-Disposition: attachment; filename=\"$filename\"

$attachment";
     }
   }
   $message.="
--$boundary--";

  if ($filesize < 10000000) { // проверка на общий размер всех файлов. Многие почтовые сервисы не принимают вложения больше 10 МБ
    mail($to, $subject, $message, $headers);
  /*  echo $_POST['txtname'].', Ваше сообщение получено, спасибо!'; */
    echo '<script language="JavaScript">alert("Ваше сообщение доставлено!");location.href="http://freepj.890m.com";</script>';
  } else {
   /*  echo 'Извините, письмо не отправлено. Размер всех файлов превышает 10 МБ.';*/
   echo '<script language="JavaScript">alert("Извините, письмо не отправлено. Размер всех файлов превышает 10 МБ.");location.href="http://freepj.890m.com";</script>';
  }

}
?>	