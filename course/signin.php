<?php
session_start();
require_once('db.php'); // Подключение к базе данных должно идти до вывода любого контента

if (isset($_POST['login']) && isset($_POST['password'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];

    // Запрос в базу данных на пользователя
    $stmt = $conn->prepare("SELECT UserID, Password FROM users WHERE Login = ?");
    if (!$stmt) {
        die('Ошибка подготовки запроса: ' . $conn->error);
    }
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
    
        // Проверка пароля
        if (password_verify($password, $user['Password'])) {
            $_SESSION['user_id'] = $user['UserID']; // Сохраняем user_id в сессии
            header("Location: prof.php"); // Перенаправляем на профиль пользователя
            exit();
        } else {
            $_SESSION['login_error'] = "Неверный логин или пароль"; // Сохраняем сообщение об ошибке в сессии
        }
    } else {
        $_SESSION['login_error'] = "Неверный логин или пароль"; // Сохраняем сообщение об ошибке в сессии
    }
    
    $stmt->close();
}

require_once('header.php'); // Подключение header.php должно идти после обработки PHP и перед HTML, если есть вывод в header.php

// Вывод сообщения об ошибке
if (isset($_SESSION['login_error'])) {
    echo $_SESSION['login_error'];
    unset($_SESSION['login_error']); // Чистим сообщение об ошибке после вывода
}
?>

<div class="container">
    <main class="main-reg">
        <div class="circle"></div>
        <div class="register-form-container">
            <h1 class="form-title">
                Войти в аккаунт
            </h1>
            <form method="post">
                <div class="form-field">
                    <input type="text" name="login" placeholder="Login">
                </div>
                <div class="form-field">
                    <input type="password" name="password" placeholder="Пароль">
                </div>
                <div class="from-buttons">
                    <button class="button" type="submit">Войти</button>
                    <div class="ore">Или</div>
                    <a href="signup.php" class="button button-reg">Зарагестрироваться</a>
                </div>
            </form>
        </div>
    </main>
</div>