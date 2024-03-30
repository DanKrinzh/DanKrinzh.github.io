<?php
session_start();
require_once('header.php');
require_once('db.php');

// Получение id услуги из GET-запроса
$serviceId = isset($_GET['id']) ? $_GET['id'] : 0;

// Запрос к базе данных для получения информации об услуге
$stmt = $conn->prepare("SELECT name_services, price_services, info_services, details_services, term_services FROM services WHERE id_services = ?");
$stmt->bind_param("i", $serviceId);
$stmt->execute();
$result = $stmt->get_result();
$service = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>
<body>
    <div class=" exam_cont">
        <div class="head_examples">
            <div class="left_block">
                <!-- Отображение названия выбранной услуги -->
                <h1 class="name_exam"><?php echo htmlspecialchars($service['name_services']); ?></h1>
                <a class="btn-aut btn btn-outline-dark" href="entry.php?id=<?php echo $serviceId; ?>">Записаться</a>
            </div>
            <div class="right_block">
                <img class="primer_photo" src="media/photo1.jpg" alt="" srcset="">
            </div>
        </div>
        <div class="container outline">
            <!-- Отображение информации о выбранной услуге -->
            <p><?php echo htmlspecialchars($service['info_services']); ?></p>
        </div>
        <div class="examples_of_work">
            <img src="" alt="">
        </div>
    </div>
</body>
<?php require_once('footer.php'); ?>
