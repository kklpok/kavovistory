<?php
// Підключення до бази даних (приклад)
$servername = "ваш_сервер";
$username = "ваш_користувач";
$password = "ваш_пароль";
$dbname = "ваша_база_даних";

$conn = new mysqli($servername, $username, $password, $dbname);

// Перевірка підключення
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Отримання даних з форми
$name = $_POST['name'];
$email = $_POST['email'];
$product = $_POST['product'];
$quantity = $_POST['quantity'];

// Валідація даних (приклад)
if (empty($name) || empty($email) || empty($product) || empty($quantity)) {
    echo "Будь ласка, заповніть всі поля.";
    exit;
}

// Підготовка SQL запиту з параметрами (захист від SQL-ін'єкцій)
$sql = "INSERT INTO замовлення (ім'я, email, товар, кількість) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssi", $name, $email, $product, $quantity);

// Виконання запиту
if ($stmt->execute()) {
    echo "<h2>Дякуємо за ваше замовлення!</h2>";
    echo "<p>Ми скоро з вами зв'яжемося.</p>";
} else {
    echo "Помилка при збереженні замовлення: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>