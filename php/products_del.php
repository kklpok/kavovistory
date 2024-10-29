<?php
$img_dir = "../img/"; // папка з фото продукції
$img_w = 220; // ширина зображення
$hostname = "localhost";
$username = "root";
$password = "";
$dbName = "eeee";
$table = "products";

// Створюємо з'єднання через mysqli
$mysqli = new mysqli($hostname, $username, $password, $dbName);

// Перевірка з'єднання
if ($mysqli->connect_error) {
    die("Помилка підключення: " . $mysqli->connect_error);
}

// Встановлюємо кодировку UTF-8
$mysqli->set_charset("utf8");

// Перевіряємо, чи було натиснуто на посилання для видалення запису
if (isset($_GET['del'])) {
    $del_ID_P = intval($_GET['del']); // Отримуємо ID для видалення та захищаємо від ін'єкцій
    $query_delete = "DELETE FROM $table WHERE ID_P = ?";
    $stmt = $mysqli->prepare($query_delete);
    $stmt->bind_param("i", $del_ID_P);

    // Виконуємо видалення
    if ($stmt->execute()) {
        // Перенаправлення для оновлення сторінки
        header("Location: " . $_SERVER['PHP_SELF']);
        exit; // Виходимо після перенаправлення
    } else {
        echo "<div style='text-align: center; color: #FF0066;'>Помилка видалення запису: " . $stmt->error . "</div>";
    }

    $stmt->close();
}

// Виконуємо запит для отримання даних
$query = "SELECT * FROM $table";
$res = $mysqli->query($query);

if (!$res) {
    die("Помилка отримання записів: " . $mysqli->error);
}

// Виводимо HTML заголовки після перевірки видалення
echo ("
<!DOCTYPE html>
<html lang='uk'>
<head>
    <meta charset='UTF-8'>
    <title>Виведення і видалення товарів із каталогу</title>
    <style type='text/css'>
        body { font: 12px Georgia; color: #663366; background-color: #FFE6F2; }
        h3 { font-size: 16px; text-align: center; color: #CC3399; }
        table { width: 700px; border-collapse: collapse; margin: 0px auto; background: #FFCCE5; border: 2px solid #FF66B2; }
        td { padding: 5px; text-align: center; vertical-align: middle; border: 1px solid #FF66B2; color: #663366; }
        .buttons { width: auto; border: 1px solid #FF66B2; background: #FF99CC; color: #663366; padding: 5px; cursor: pointer; }
        a { color: #CC0066; text-decoration: none; }
        a:hover { color: #FF0066; }
    </style>
</head>
<body>
<h3>Виведення і видалення товарів із каталогу</h3>
<table>
<tr>
    <td><b>#</b></td>
    <td align='center'><b>Назва</b></td>
    <td align='center'><b>Опис</b></td>
    <td align='center'><b>Ціна</b></td>
    <td align='center'><b>Фото</b></td>
    <td align='center'><b>Видалення</b></td>
</tr>
");

// Виводимо дані з таблиці
while ($row = $res->fetch_assoc()) {
    echo "<tr>\n";
    echo "<td>" . $row['ID_P'] . "</td>\n";
    echo "<td>" . $row['Name_P'] . "</td>\n";
    echo "<td>" . $row['Description'] . "</td>\n";
    echo "<td>" . $row['price'] . "</td>\n";
    echo "<td><img width='" . $img_w . "' src='" . $img_dir . $row['img'] . "'></td>\n";

    // Генеруємо посилання для видалення запису
    echo "<td><a href='?del=" . $row['ID_P'] . "' onclick=\"return confirm('Ви впевнені, що хочете видалити цей запис?');\">Видалити</a></td>\n";
    echo "</tr>\n";
}

echo ("</table>\n");

// Закриваємо з'єднання
$mysqli->close();

// Посилання для повернення
echo ("<div style='text-align: center; margin-top: 10px;'><a href='login.php' class='buttons'>Повернутися назад</a></div>");
?>
</body>
</html>
