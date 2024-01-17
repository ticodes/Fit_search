<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kursach";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Проверка паролей на совпадение
    if ($password !== $confirm_password) {
        echo "Пароли не совпадают.";
        exit();
    }

    // Хеширование пароля перед сохранением в базу данных
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashed_password);

    if ($stmt->execute()) {
        echo "Регистрация успешна. Данные добавлены в базу данных.";
        header("Location: test.php");
        exit();
    } else {
        echo "Ошибка при регистрации: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
