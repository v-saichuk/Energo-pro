 <?php
$to = '#'; // От кого отправляем письмо
$email = '#'; // Кому отправляем письмо

if ( isset( $_POST['sendMail'] ) ) {
	$name	= substr( $_POST['user_name'], 0, 64 );
	$tel = substr( $_POST['user_tel'], 0, 64 );
	$cod_filter	= substr( $_POST['cod-filter'], 0, 64 );

	if($_FILES) {

		$filepath = array();
		$filename = array();
		$file2 = array();
		$i = 0;
			foreach ($_FILES["file"]["error"] as $key => $error) {
				if ($error == UPLOAD_ERR_OK) {
					$filename[$i][0] = $_FILES["file"]["tmp_name"][$key];
					$filename[$i][1] = $_FILES["file"]["name"][$key];
					$i++;
				}
			}
	}

	$body = "Имя: ".$name."\r\n\r\n";
	$body .= "Номер телефона: ".$tel."\r\n\r\n";
	$body .= "Код фильтра: ".$cod_filter; 
	$body .= "Автор верстки (Виталий Сайчук): "; 
	send_mail($to, $body, $email, $filename);
}


function send_mail($to, $body, $email, $filename)
{
	$subject = 'Новое сообщение с сайта';
	$boundary = "--".md5(uniqid(time()));
	$headers = "From: ".$email."\r\n";	 
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .="Content-Type: multipart/mixed; boundary=\"".$boundary."\"\r\n";
	$multipart = "--".$boundary."\r\n";
	$multipart .= "Content-type: text/plain; charset=\"utf-8\"\r\n";
	$multipart .= "Content-Transfer-Encoding: quoted-printable\r\n\r\n";

	$body = $body."\r\n\r\n";
 
	$multipart .= $body;
	foreach ($filename as $key => $value) {
		$fp = fopen($value[0], "r"); 
		$content = fread($fp, filesize($value[0]));
		fclose($fp);
		$file .= "--".$boundary."\r\n";
		$file .= "Content-Type: application/octet-stream\r\n";
		$file .= "Content-Transfer-Encoding: base64\r\n";
		$file .= "Content-Disposition: attachment; filename=\"".$value[1]."\"\r\n\r\n";
		$file .= chunk_split(base64_encode($content))."\r\n";
	}
	$multipart .= $file."--".$boundary."--\r\n";
	mail($to, $subject, $multipart, $headers);
}
?>