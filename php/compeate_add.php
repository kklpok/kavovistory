<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Додати товар</title>
    <link rel="stylesheet" href="..\css\style_php.css" type="text/css">
    <link rel="shortcut icon" href="..\img\4.jpg" type="image/x-icon" />
</head>
<body>
<p>
    <?php
    @session_start();

    // Отримання даних з форми
    $Name_P_db = $_POST['Name_P_db'];
    $Description_db = $_POST['Description_db'];
    $price_db = $_POST['price_db'];
    $Number_db = $_POST['Number_db'];

    // Перевірка, що всі поля заповнені
    if (empty($Name_P_db) || empty($Description_db) || empty($Number_db) || empty($price_db)) {
        echo "<b>Помилка:</b> Всі поля повинні бути заповнені.";
    } else {
        // Підключення до бази даних
        $mysqli = new mysqli("localhost", "root", "", "eeee");

        // Перевірка з'єднання
        if ($mysqli->connect_error) {
            die("Помилка підключення: " . $mysqli->connect_error);
        }

        // Встановлення кодування UTF-8
        $mysqli->set_charset("utf8");

        // Шлях до папки для завантаження зображень
        $uploaddir = '../img/';
        $img_db = basename($_FILES['img_db']['name']);
        $dest = $uploaddir . $img_db;

        echo "<h2>Малюнок</h2>" . $dest;

        // Завантаження зображення
        if (move_uploaded_file($_FILES['img_db']['tmp_name'], $dest)) {
            echo "<b>Успішно</b> завантажений <br />";
        } else {
            echo "<b>Помилка</b> при завантаженні файлу <br />";
        }

        // Виведення товару
        echo "<br /><h2>Товар</h2> " . $Name_P_db . "/" . $Description_db . "/" . $Number_db . "/" . $price_db . "<br />";

        // Запит для вставки товару в базу даних
        $stmt = $mysqli->prepare("INSERT INTO products (Name_P, Description, Number, price, img) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdis", $Name_P_db, $Description_db, $Number_db, $price_db, $img_db);

        // Виконання запиту
        if ($stmt->execute()) {
            echo "<b>Успішно</b> доданий <br /><br />";
        } else {
            echo "<b>Помилка</b> при додаванні товару: " . $stmt->error . " <br /><br />";
        }

        // Закриття запиту та з'єднання
        $stmt->close();
        $mysqli->close();
    }
    ?>
</p>

<p><a href="www/product_add.html">Додати наступний</a> - <a href="products.php">Переглянути каталог</a></p>
</body>
</html>
