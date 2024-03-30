<?php
session_start();
ob_start();
require_once('header.php');
require_once('db.php');

if (isset($_POST['signup'])) {
    $name = $_POST['name'];
    $login = $_POST['login'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_2 = $_POST['password_2'];

    // Проверка на совпадение паролей
    if ($password != $password_2) {
        $_SESSION['message'] = 'Пароли не совпадают';
        header("Location: singup.php");
        exit();
    }

    // Хэширование пароля
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Вставка данных в базу данных
    $sql = "INSERT INTO Users (Username, Login, Email, Password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $login, $email, $hashed_password);

    if ($stmt->execute()) {
        $_SESSION['message'] = 'Регистрация успешна!';
        header("Location: signin.php");
        exit();
    } else {
        $_SESSION['message'] = 'Ошибка регистрации: ' . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
ob_end_flush();
?>
<body>
    <div class="container">
        <main class="main-reg">
            <div class="register-form-container">
                <form action="signup.php" method="post">
                    <h1 class="form-title">
                        Регистрация
                    </h1>
                    <div class="form-field">
                        <input type="text" name="name" placeholder="ФИО">
                    </div>
                    <div class="form-field">
                        <input type="text" name="login" placeholder="Логин">
                    </div>
                    <div class="form-field">
                        <input type="email" name="email" placeholder="Email">
                    </div>
                    <div class="form-field">
                        <input type="password" name="password" placeholder="Пароль">
                    </div>
                    <div class="form-field">
                        <input type="password" name="password_2" placeholder="Повторите пароль">
                    </div>
                    <div class="from-buttons">
                        <button class="button" type="submit" name="signup" >Зарагестрироваться</button>

                    </div>
                </form>
            </div>
        </main>
    </div>
    
    <script src="js/bootstrap.js" class="logo"></script>
</body>