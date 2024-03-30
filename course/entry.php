<?php
session_start();
require_once('db.php'); // Подключение к БД

// Получение id услуги из GET-запроса
$serviceId = isset($_GET['id']) ? $_GET['id'] : null;
$serviceName = "Выбранная услуга"; // Значение по умолчанию для названия услуги

// Обработка отправки формы
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['book'])) {
    // Получение данных из формы
    $userId = $_SESSION['user_id']; // Убедитесь, что user_id установлен в сессии
    $serviceId = $_POST['service_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    // Вставка записи в базу данных
    $stmt = $conn->prepare("INSERT INTO appointments (user_id, service_id, appointment_date, appointment_time) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('iiss', $userId, $serviceId, $date, $time);
    
    if ($stmt->execute()) {
        // Переход на страницу профиля после успешной записи
        header("Location: prof.php");
        exit;
    } else {
        // Вывод сообщения об ошибке
        $error = "Ошибка при создании записи: " . $stmt->error;
        echo $error;
    }
    
    $stmt->close();
}

// Если service_id получен, получаем название услуги из базы данных
if ($serviceId) {
    $stmt = $conn->prepare("SELECT name_services FROM services WHERE id_services = ?");
    $stmt->bind_param('i', $serviceId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $serviceName = $row['name_services']; // Получаем название услуги из базы данных
    }
    $stmt->close();
}

require_once('header.php');
?>

<body>
    <div class="exam_cont">
        <div class="head_examples">
            <div class="left_block">
                <h1 class="name_exam"><?php echo htmlspecialchars($serviceName); ?></h1>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $serviceId; ?>" method="post">
                    <input type="hidden" name="service_id" value="<?php echo $serviceId; ?>">
                    <label for="date">Выберите дату:</label>
                    <input type="date" id="date" name="date" required>
                    <label for="time" class="form-label">Выберите время:</label>
                    <select class="form-control" id="time" name="time" required></select>
                    <input type="submit" name="book" value="Записаться">
                </form>
            </div>
        </div>
    </div>
    <script>
    document.getElementById('date').addEventListener('change', function() {
        var selectedDate = this.value;
        var timeSelect = document.getElementById('time');
        timeSelect.innerHTML = ''; // Очистить текущие опции времени

        if(selectedDate) {
            fetch('getBookedSlots.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'date=' + selectedDate
            })
            .then(response => response.json())
            .then(bookedSlots => {
                console.log(bookedSlots); // Для отладки: вывод занятых слотов
                var startHour = 10; // 10 утра
                for(var hour = startHour; hour <= 17; hour += 2) { // до 18:00 включительно
                    var timeValue = (hour < 10 ? '0' + hour : hour) + ':00';
                    if (!bookedSlots.includes(timeValue)) {
                        var timeOption = new Option(timeValue, timeValue);
                        timeSelect.options.add(timeOption);
                    }
                }
                timeSelect.removeAttribute('disabled');
            })
            .catch(error => console.error('Error:', error));
        } else {
            timeSelect.setAttribute('disabled', 'disabled');
        }
    });
</script>
</body>

<?php require_once('footer.php'); ?>
