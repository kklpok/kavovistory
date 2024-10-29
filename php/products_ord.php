<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Замовлення продукції</title>
<link rel="stylesheet" href="..\css\style_php.css" type="text/css">
<link rel="shortcut icon" href="..\img\1.png" type="image/x-icon" />
</head>
<body>
	<?php
		$img_dir="../img/";
		$img_w=220;
		$pg=5; // кількість продукції, яка буде відображатися на сторінці
		if (isset($_GET['p'])) {$p=$_GET['p']; }
			else {$p=0;}
			echo "<p><h2 align=center><b>Замовлений товар</b></h2></p>";
			$db = mysql_connect("localhost", "root", "");
			mysql_select_db("eeee");
			mysql_query ("set names 'utf8'");
			$res = mysql_query("select `realization`.`ID`, `realization`.`DateZ`, `products`.`img`,`products`.`Name_P`,`products`.`price`, `realization`.`Number_Z`, `realization`.`cost`
				from `products`, `realization`
				where `realization`.`ID` limit ".($p*$pg).",".($p*$pg+$pg).";");
			while ($row = mysql_fetch_array($res)) {
				echo "<table style=\"margin-left: 15%;width: 80%;\"><tr><td><p align=center><img  width=\"".$img_w."\" src=\"".$img_dir.$row['img']."\"></p></td><td><table style=\" width: 80%\">";
					echo "<tr style=\"background-color: #E0E0E0;\"><td><b>Дата продажу:</b></td><td>".$row['DateZ']."</td></tr>";
					echo "<tr><td><b>Назва:</b></td><td>".$row['Name_P']."</td></tr>";
					echo "<tr style=\"background-color: #E0E0E0;\"><td><b>Ціна:</b></td><td>".$row['price']."  грн.</td></tr></td>";
					echo "<tr><td><b>Кількість:</b></td><td>".$row['Number_Z']."</td></tr>";
					echo "<tr style=\"background-color: #E0E0E0;\"><td><b>Вартість:</b></td><td>".$row['cost']."</td></tr></table></td>";
					}
				echo "</table>";
			$res = mysql_query("select count(*) as 'cnt' from `realization`;");
			$row = mysql_fetch_array($res);
			$cnt=$row['cnt'];
			echo "<p align=center>Товарів в каталозі <b>".$cnt."</b><br>";	
			if (!($p==0)){
			echo "<a href=\"products.php?p=".($p-1)."\"><button>Назад</button></a>";}
				if (($cnt/(++$p*$pg))>1){
				echo "<a href=\"products.php?p=".($p--)."\"><button>Далі</button></a></p>";}
			mysql_close($db);
?>
</body>
</html>