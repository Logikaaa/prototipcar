<?php
session_start(); // Запускаємо сесію

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST["username"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Підключення до бази даних
    $conn = new mysqli("localhost", "root", "", "cookbook");
    if ($conn->connect_error) {
        die("Помилка підключення: " . $conn->connect_error);
    }

    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        header("Location: http://127.0.0.1:5500/login.html"); // Переадресація на сторінку входу
        exit();
    } else {
        echo "Помилка: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
