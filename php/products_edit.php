<?php
/* З'єднуємося з БД */
$hostname = "localhost"; // назва/шлях сервера MySQL
$username = "root"; // ім'я користувача
$password = ""; // пароль (за замовчуванням порожній)
$dbName = "eeee"; // назва БД
$table = "products"; // назва таблиці в БД

/* Створюємо з'єднання */
$mysqli = new mysqli($hostname, $username, $password, $dbName);

/* Перевіряємо з'єднання */
if ($mysqli->connect_error) {
    die("Не вдалося з'єднатися: " . $mysqli->connect_error);
}

/* Встановлюємо кодування UTF-8 */
$mysqli->set_charset("utf8");

/* Якщо натиснуто кнопку редагувати - вносимо зміни */
if (isset($_POST['submit_edit'])) { // Перевіряємо, чи натиснута кнопка "Зберегти зміни"
    // Заносимо у змінні дані з форми для активного запису
    $update = $_POST['update']; // ID продукту для оновлення
    $Name_P = $_POST['Name_P']; // Назва продукту (ім'я стовпця "name")
    $Description = $_POST['Description']; // Опис продукту
    $price = $_POST['price']; // Ціна продукту
    $img = $_POST['img']; // Зображення продукту

    // Формуємо запит для поновлення активного запису
    $query = "UPDATE $table SET Name_P='$Name_P', Description='$Description', price='$price', img='$img' WHERE ID_P='$update'";

    /* Виконуємо запит. Якщо виникла помилка - вивести її */
    if (!$mysqli->query($query)) {
        die("Помилка: " . $mysqli->error);
    }
}

/* Заносимо в змінну $res всю таблицю */
$query = "SELECT * FROM $table"; // Формуємо запит для вибору всіх записів з таблиці
/* Виконуємо запит. Якщо виникла помилка - вивести її */
$res = $mysqli->query($query);
if (!$res) {
    die("Помилка: " . $mysqli->error);
}
/* Визначаємо кількість записів в таблиці */
$row_count = $res->num_rows; // Повертає кількість записів

/* Виводимо дані з таблиці */
echo ("
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\"
\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
<title>Редагування і поновлення даних</title>
<style type=\"text/css\">
<!--
/* Твій CSS-код залишається тут без змін */
-->
</style>
</head>
<body>
<h3>Редагування і поновлення даних</h3>
");

while ($row = $res->fetch_assoc()) { // Проходимо через всі записи таблиці
    echo "<form action=\"products_edit.php\" method=\"post\" name=\"edit_form\">\n";
    echo "<input type=\"hidden\" name=\"update\" value=\"".$row['ID_P']."\" />\n"; // Сховане поле з ID продукту
    echo "<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\">\n";
    echo "<tr>\n";
    echo "<td colspan=\"2\" style=\"border-bottom:solid 1px #CCCCCC;\"><b><i><div id=\"num\">#".$row["ID_P"]."</div></b></i></td>\n"; // Відображає ID продукту
    echo "</tr><tr>\n";
    echo "<td>Назва:</td><td><input type=\"text\" value=\"".$row['Name_P']."\" name=\"Name_P\" /></td>\n"; // Поле для редагування назви
    echo "</tr><tr>\n";
    echo "<td>Опис:</td><td><input type=\"text\" value=\"".$row['Description']."\" name=\"Description\" /></td>\n"; // Поле для редагування опису
    echo "</tr><tr>\n";
    echo "<td>Ціна:</td><td><input type=\"text\" value=\"".$row['price']."\" name=\"price\" /></td>\n"; // Поле для редагування ціни
    echo "</tr><tr>\n";
    echo "<td>Фото у каталозі:</td><td>".$row['img']."</td>\n"; // Відображає поточне зображення
    echo "</tr><tr>\n";
    echo "<td>Вибрати інше фото:</td><td><input type=\"file\" value=\"".$row['img']."\" name=\"img\" /></td>\n"; // Поле для вибору нового зображення
    echo "</tr><tr>\n";
    echo "<td colspan=\"2\" align=\"center\"><input type=\"submit\" name=\"submit_edit\" class=\"buttons\" value=\"Зберегти зміни\" /></td>\n"; // Кнопка для збереження змін
    echo "</tr></table></form>\n\n";
}

/* Закриваємо з'єднання */
$mysqli->close(); // Закриваємо з'єднання з базою даних

/* Виводимо посилання повернення */
echo ("<div style=\"text-align: center; margin-top: 10px;\"><a href=\"../A_U.html\">Повернутися назад</a></div>");
?>
</body>
</html>
