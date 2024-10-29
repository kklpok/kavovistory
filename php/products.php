<?php session_start(); ?>
<!DOCTYPE html>
<html lang="uk">
<head>
<meta charset="UTF-8" />
<title>Каталог продукції</title>
<link rel="stylesheet" href="..\css\style_php.css" type="text/css">
<link rel="shortcut icon" href="http://spivak_site.ua/img/4.jpg" type="image/x-icon" />
<style> 
    button {
        width: 20%;
        padding: 10px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 3%;
    }
    img {
        align-content: center;
    }
</style>
</head>
<body>
    <?php
    // Параметри для підключення
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "eeee";
    
    // Підключення до бази даних через mysqli
    $db = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    
    // Перевірка підключення
    if (!$db) {
        die("Помилка підключення: " . mysqli_connect_error());
    }
    
    // Встановлюємо кодування для правильного відображення українських символів
    mysqli_set_charset($db, "utf8");

    // Директори для зображень
    $img_dir = "../img/";
    $img_w = 220;
    $pg = 2; // кількість продукції на сторінці

    // Визначаємо сторінку
    if (isset($_GET['p'])) {
        $p = (int)$_GET['p']; 
    } else {
        $p = 0;
    }

    echo "<p><h2 align='center'>Каталог <b>Продукції</b></h2></p>";

    // Вибірка даних з бази
    $offset = $p * $pg;
    $query = "SELECT * FROM `products` ORDER BY `ID_P` LIMIT $offset, $pg";
    $res = mysqli_query($db, $query);

    // Перевірка запиту на помилки
    if ($res) {
        echo "<table style='margin-left: 15%; width: 80%;'>";
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td><p align='center'><img width='$img_w' src=\"".$img_dir.$row['img']."\"></p></td>";
            echo "<td><table style='width: 80%;'>";
            echo "<tr style='background-color: #E0E0E0;'><td><b>Назва:</b></td><td>" . $row['Name_P'] . "</td></tr>";
            echo "<tr><td><b>Опис:</b></td><td>" . $row['Description'] . "</td></tr>";
            echo "<tr style='background-color: #E0E0E0;'><td><b>Ціна:</б></td><td>" . $row['price'] . " грн.</td></tr>";
            echo "</table></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Помилка при виконанні запиту: " . mysqli_error($db);
    }

    // Отримання кількості товарів для пагінації
    $res = mysqli_query($db, "SELECT COUNT(*) AS 'cnt' FROM `products`");
    $row = mysqli_fetch_assoc($res);
    $cnt = $row['cnt'];

    echo "<p align='center'>Товарів в каталозі: <b>" . $cnt . "</b><br>";


    // Кнопки "Назад" та "Далі"
    echo "<div style='text-align: center;'>";
    if ($p > 0) {
        echo "<a href='products.php?p=" . ($p - 1) . "'><button>Назад</button></a> ";
    } else {
        echo "<p>Кнопка 'Назад' не показується, бо це перша сторінка.</p>";
    }

    if ($cnt > ($offset + $pg)) {
        echo "<a href='products.php?p=" . ($p + 1) . "'><button>Далі</button></a>";
    } else {
        echo "<p>Кнопка 'Далі' не показується, бо немає більше товарів для відображення.</p>";
    }
    echo "</div>";


    // Закриття підключення
    mysqli_close($db);
    echo ("<div style='text-align: center; margin-top: 10px;'><a href='login.php/36' class='buttons'>Повернутися назад</a></div>");
    ?>

</body>
</html>
