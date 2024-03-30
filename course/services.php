<?php
session_start();
require_once('header.php');
require_once('db.php');

// Запрос к базе данных для извлечения информации о услугах
$sql = "SELECT id_services, name_services, price_services, info_services, details_services, term_services FROM services";
$result = $conn->query($sql);

$services = [];

// Извлечение результатов запроса
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $services[] = $row;
    }
}

$conn->close();
?>
<body>
    <div class="container">
        <div class="h1-title">
            <h1 class="title">Услуги</h1>
        </div>
        <!-- Переменная для чередования столбцов -->
        <?php $isLeft = true; ?>
        <!-- Перебор массива услуг -->
        <?php foreach ($services as $service): ?>
            <?php if ($isLeft): ?>
                <!-- Открываем контейнер для сервиса если это левая колонка -->
                <div class="info-servis">
            <?php endif; ?>

            <!-- Блок для каждой колонки услуги -->
            <div class="<?php echo $isLeft ? 'left-column' : 'right-column'; ?>">
                <div class="<?php echo $isLeft ? 'big-info-servis' : 'min-info-servis'; ?>">
                    <div class="content-servic">
                        <div class="name-servis">
                            <h1><?php echo htmlspecialchars($service['name_services']); ?></h1>
                            <h1><?php echo htmlspecialchars($service['price_services']); ?></h1>
                        </div>
                        <div class="info-servis">
                            <p><?php echo htmlspecialchars($service['info_services']); ?></p>
                        </div>
                        <!-- Дополнительные детали и кнопки только для левой колонки -->
                        <?php if ($isLeft): ?>
                            <div class="info-servis">
                                <p><?php echo htmlspecialchars($service['details_services']); ?></p>
                            </div>
                            <div class="time-servis">
                                <h1>Сроки:</h1>
                                <p><?php echo htmlspecialchars($service['term_services']); ?></p>
                            </div>
                        <?php endif; ?>
                        <div class="d-grid gap-2 button-down">
                            <a class="butbut-one" href="examples.php?id=<?php echo $service['id_services']; ?>">Узнать больше</a>
                            <a class="butbut-down" href="entry.php?id=<?php echo $service['id_services']; ?>">Записаться</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Закрываем контейнер для сервиса если это правая колонка -->
            <?php if (!$isLeft): ?>
                </div> <!-- Закрывающий тег для .info-servis -->
            <?php endif; ?>

            <!-- Переключаем сторону для следующего сервиса -->
            <?php $isLeft = !$isLeft; ?>
        <?php endforeach; ?>
        
        <!-- Если количество услуг нечетное, закрываем открытый div.info-servis -->
        <?php if (!$isLeft): ?>
            </div> <!-- Закрывающий тег для .info-servis, если количество элементов нечетное -->
        <?php endif; ?>
    </div>

</body>


<?php require_once('footer.php'); ?>
