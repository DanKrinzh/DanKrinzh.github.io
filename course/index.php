<?php
session_start();
require_once('db.php');

$sql = "SELECT id, full_name, specialization, photo FROM specialist"; // Замените 'tablename' на имя вашей таблицы
$result = $conn->query($sql);

$specializes = [];

// Извлечение результатов запроса
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $specializes[] = $row;
    }
}


$conn->close();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>главная</title>
</head>
<body>
    <div class="hero">
        <video autoplay loop muted plays-inline class="back-video">
            <source src="media/Untitled.mp4" type="video/mp4">
        </video>
        <nav>
            <a href="index.php"><img  src="media/WhiteLogo.png" class="logo"></a>
            <ul>
                <li><a href="index.php">Главная</a></li>
                <li><a href="services.php">Услуги</a></li>
                <li><a href="">Наши работы</a></li>
                <li><a href="#about-as-container">О нас</a></li>
                <li><a href="footer.php">Где нас найти?</a></li>
            </ul>
            <div class="text-end">
            <?php if (isset($_SESSION['user_id'])): ?>
            <!-- Если пользователь авторизован, показываем кнопку профиля -->
            <a class="btn-aut btn btn-outline-light" href="prof.php">Профиль</a>
            <a class="btn-aut btn btn-outline-light" href="logout.php">Выход</a>
        <?php else: ?>
            <!-- Если пользователь не авторизован, показываем кнопки входа и регистрации -->
            <a href="signin.php" type="button" class="btn-aut btn btn-outline-light">Войти</a>
            <a href="signup.php" type="button" class="btn-reg btn btn-outline-light">Регистрация</a>
        <?php endif; ?>

              </div>
        </nav>
        <div class="content">
            <h1>Искусство интерьеров</h1>
            <a href="" class="btn-aut btn btn-outline-light">Далее</a>
            
        </div>
    </div>
    <div id="about-as-container" class="about-as-container">
        <div  class="container">
            <h1 class="about-as-h">DesignAndYou</h1>
            <p class="about-as-p">Представляем нашу команду выдающихся дизайнеров,<br>
                 специализирующихся на разработке проектов<br>
                 для оформления вашей квартиры, дома и отдельных комнат.</p>
                 
            <p class="about-as-p">Наша миссия заключается в создании.<br> 
                 Каждый из наших дизайн-проектов представляет собой<br>
                проницательный взгляд в современное будущее.<br>
                Мы стремимся к созданию уникальных<br> 
                и роскошных интерьеров в различных стилях дизайна.</p>

            <img class="about-img" src="media/photo1.jpg" alt="" srcset="">
            <div class="arrow-8"></div>
        </div>
    </div>
    <div class="our-projects">
        <div class="container our-cunt-head">
            <h1 class="our-projects-h">Наша команда</h1>
        </div>
        <div class="container our-cunt">
    <div class="ryad">
        <?php foreach ($specializes as $specialize): ?>
            <div class="min-cont-for-spec">
                <img class="photo-spec" src="<?php echo htmlspecialchars($specialize['photo']);?>"  alt="">
                <div class="info-spec">
                    <h1 class="name-spec"><?php echo htmlspecialchars($specialize['full_name']);?></h1>
                    <p class="rab-spec"><?php echo htmlspecialchars($specialize['specialization']);?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
    <script src="js/bootstrap.js" ></script>
    <script src="js/uhod.js"></script>
</body>
</html>
<?php
session_start();
require_once('footer.php');
?>