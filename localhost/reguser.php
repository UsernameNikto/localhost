<?php

$host_name = "localhost";
$db_name = "Users";
$username = "root";
$password = "root";

// Соединение с базой данных
$conn = new mysqli($host_name, $username, $password, $db_name);

if ($conn->connect_error) {
    die("Соединение с базой данных не удалось: " . $conn->connect_error);
}

// Очистка данных
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Проверка данных и добавление нового пользователя
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = test_input($_POST["login"]);
    $password = test_input($_POST["password"]);

    $sql = "INSERT INTO users (login,  password, user_type) VALUES ('$login', '$password', 'user')";

    if ($conn->query($sql) === TRUE) {
        echo "Новый пользователь добавлен успешно";
        echo "<script> location.href='SLMSL.html'; </script>";
        exit;
    } else {
        echo "Ошибка: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>