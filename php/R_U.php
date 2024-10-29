<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
	<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Реєстрація</title>
</head>
<body>
<p>
<?php
  $db = mysql_connect("localhost", "root", "");
  mysql_select_db("eeee");
  $Name=$_POST['Name'];
  $email=$_POST['email'];
  $login=$_POST['login'];
  $password=$_POST['password'];
  echo "<br /><h2>Користувач</h2>".$Name."/".$email."/".$login."/".$password."<br />";
	$res = mysql_query("INSERT INTO `user` VALUES (NULL, '".$Name."', '".$email."', '".$login."', '".$password."');");
  if ($res)
	{echo "<b>успішно зареєстрований.</b><br /><br />";
	echo "<a href=\"..\A_U.html\"><b>УВІЙТИ</b></a>";}
  else
	{echo "<b>виникла помилка при реєстрації.</b><br /><br /><a href=\"..\R_U.html\">ПОВТОРИТИ</a>";}
	mysql_close($db);
?>
</p>
</body> </html>