<?php
$servername = 'localhost'; // адрес сервера БД
$username = 'root'; // имя пользователя
$password = 'root'; // пароль пользователя
$dbname = 'mysql'; // имя базы данных

$conn = new mysqli($servername, $username, $password, $dbname);

$conn->set_charset("utf8mb4");

// Проверка соединения
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$patronymic = $_POST['patronymic'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$selectedProducts = isset($_POST["products"]) ? $_POST["products"] : [];
$comments = $_POST['comments'];

foreach ($selectedProducts as $product) {
    // Подготовка SQL-запроса на вставку
    $sql = "INSERT INTO orders (firstname, lastname, patronymic, address, phone, email, products, comments)
            VALUES ('$firstname', '$lastname', '$patronymic', '$address', '$phone', '$email', ?, '$comments')";

    // Используйте подготовленные выражения для вставки значений
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $product);

    // Выполните запрос
    if ($stmt->execute() === TRUE) {
        echo "Товар \"$product\" успешно добавлен в заказ.";
    } else {
        echo "Ошибка при добавлении товара \"$product\": " . $conn->error;
    }

    // Закрытие подготовленного выражения
    $stmt->close();
}

// Закрыть соединение с базой данных
$conn->close();
?>
