<?php
// Начинаем сессию в самом начале файла
session_start();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
<div class="ero">
    <nav>
        <a href="index.php"><img src="media/Black logo.png" class="logo"></a>
        <ul>
            <li><a href="index.php" class="header-link">Главная</a></li>
            <li><a href="services.php" class="header-link">Услуги</a></li>
            <li><a href="" class="header-link">Наши работы</a></li>
            <li><a href="#about-as-container" class="header-link">О нас</a></li>
            <li><a href="footer.php" class="header-link">Где нас найти?</a></li>
        </ul>
        <div class="text-end">
        <?php if (isset($_SESSION['user_id'])): ?>
            <!-- Если пользователь авторизован, показываем кнопку профиля -->
            <a class="btn-aut btn btn-outline-dark" href="prof.php">Профиль</a>
            <a class="btn-aut btn btn-outline-dark" href="logout.php">Выход</a>
        <?php else: ?>
            <!-- Если пользователь не авторизован, показываем кнопки входа и регистрации -->
            <a href="signin.php" type="button" class="btn-aut btn btn-outline-dark">Войти</a>
            <a href="signup.php" type="button" class="btn-reg btn btn-outline-dark">Регистрация</a>
        <?php endif; ?>
        </div>
    </nav>
</div>

