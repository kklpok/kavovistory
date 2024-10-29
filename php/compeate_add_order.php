<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Додання в базу замовленних товарів</title>
<link rel="stylesheet" href="..\css\style_php.css" type="text/css">
<link rel="shortcut icon" href="..\img\1.png" type="image/x-icon" />
</head>
<body><p>
    <?php
    $db = mysql_connect("localhost", "root", "");
    mysql_select_db("eeee");
    $cdate = date("Y-m-d");
    $lgn = $_SESSION['user'];
    $pss = $_SESSION['password'];
    echo "$lgn $pss" ;
    $user = mysql_query("select `ID_U` from `user` where (`login`='$lgn') and (`password`='$pss') limit 1;");
    $row1 = mysql_fetch_array($user);
    echo "Користувач id_u: " . $row1['ID_U'] . "<br />";
    $ID_P = $_POST["products"];
    foreach ($ID_P as $item) {
        $prov_v = mysql_query("select * from `products` where (`ID_P`='$item');");
        $row = mysql_fetch_array($prov_v);
        echo $item." ".$row['name']." ".$row['price']." <br />";
        $res = mysql_query("INSERT into `realization` values(NULL,'".$row1['ID_U']."','".$item."', '".$cdate."',1, '".$row['price']."');");
        if($res)
            {echo "<b>Замовлення успішно оформлено.</b><br /><br />";}
            else
            {echo "<b>Помилка при оформленні замовлення." . mysql_error() . "</b><br /><br />";}
    }
    mysql_close($db);
?>
</p>
<p><a href="products_order.php">Замовити ще товари</a> - 
<a href="products.php">Переглянути каталог</a></p> 
</body>
</html> 