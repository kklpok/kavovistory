<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Замовлення товару</title>
<link rel="stylesheet" href="..\css\style_php.css" type="text/css">
<link rel="shortcut icon" href="..\img\1.png" type="image/x-icon" />
</head>
<body>
<p><h2 align="center"> Замовити товар (вибирайте, натиснувши клавішу ctrl) </h2></p> <br />
<?php
    $db = mysql_connect("localhost", "root", "");
    mysql_select_db("eeee");
    mysql_query ("set names 'utf8'");
    $res = mysql_query("select * from `products` order by `ID_P`;");
?>
<form name="add_prod_order" method="post" action="compeate_add_order.php" enctype="multipart/form-data">
	<select id="products" name="products[]" style="height: 250px; width: 50%"multiple="multiple">
		<?php
		while($row = mysql_fetch_array($res))
		{?>
			<option value= <?php echo $row['ID_P'] ?>> <?php echo $row['ID_P']." ".$row['Name_P']."\t------".$row['price']." грн." ;?></option>
		<?php
	}
	?>
	</select>
<br><br>
<input type="submit" value="Відправити">
</form>
<?php
mysql_close($db);
?>
</body>
</html>