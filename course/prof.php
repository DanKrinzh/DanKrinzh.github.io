<?php
session_start();
require_once('db.php'); // Подключение к базе данных

// Проверяем, авторизован ли пользователь
if (!isset($_SESSION['user_id'])) {
    header('Location: signin.php'); // Перенаправление на страницу входа, если пользователь не авторизован
    exit;
}

$user_id = $_SESSION['user_id'];

// Обработка запроса на отмену записи
if (isset($_POST['cancel_appointment'])) {
    $appointment_id = $_POST['appointment_id'];

    $cancelStmt = $conn->prepare("DELETE FROM appointments WHERE id_appointment = ? AND user_id = ?");
    $cancelStmt->bind_param('ii', $appointment_id, $user_id);
    $cancelStmt->execute();
    $cancelStmt->close();

    // Перезагрузка страницы для обновления списка записей
    header("Location: prof.php");
    exit;
}

// Получаем информацию о пользователе из таблицы `users`
$userStmt = $conn->prepare("SELECT Username, Login, Email FROM users WHERE UserID = ?");
$userStmt->bind_param('i', $user_id);
$userStmt->execute();
$userResult = $userStmt->get_result();
$user = $userResult->fetch_assoc();

// Получаем записи пользователя
$appointmentsStmt = $conn->prepare("SELECT id_appointment, appointment_date, appointment_time FROM appointments WHERE user_id = ?");
$appointmentsStmt->bind_param('i', $user_id);
$appointmentsStmt->execute();
$appointmentsResult = $appointmentsStmt->get_result();
$appointments = $appointmentsResult->fetch_all(MYSQLI_ASSOC);

$userStmt->close();
$appointmentsStmt->close();

require_once('header.php'); // Подключение файла с шапкой сайта
?>
<body>
    <div class="container">
        <h2 class="kub">Личный кабинет</h2>
        <div class="container prof">
        <div class="form_prof">
            <h5>Имя:</h5> <p><?php echo htmlspecialchars($user['Username']); ?></p>
            <h5>Email:</h5> <p><?php echo htmlspecialchars($user['Email']); ?></p>
            <h5>Login:</h5><p><?php echo htmlspecialchars($user['Login']); ?></p>
        </div>
        <h5>Ваши записи:</h5>
        <?php if (count($appointments) > 0): ?>
            <div class="records-list">
                <?php foreach ($appointments as $appointment): ?>
                    <div class="record-container">
                        <div class="record-info">
                            <?php echo htmlspecialchars($appointment['appointment_date']) . ' в ' . htmlspecialchars($appointment['appointment_time']); ?>
                        </div>
                        <form method="post" action="prof.php" onsubmit="return confirm('Вы уверены, что хотите отменить запись?');">
                            <input type="hidden" name="appointment_id" value="<?php echo $appointment['id_appointment']; ?>">
                            <input type="submit" name="cancel_appointment" value="Отменить запись" class="btn btn-outline-dark">
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>У вас пока нет записей.</p>
        <?php endif; ?>

    </div>
</body>

