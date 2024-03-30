<?php
require_once('db.php'); // Подключение к базе данных

function getBookedTimeSlots($conn, $date) {
    $bookedSlots = [];
    $stmt = $conn->prepare("SELECT appointment_time FROM appointments WHERE appointment_date = ?");
    $stmt->bind_param("s", $date);
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()) {
        // Преобразование времени к формату HH:MM
        $time = date('H:i', strtotime($row['appointment_time']));
        $bookedSlots[] = $time;
    }
    $stmt->close();
    return $bookedSlots;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['date'])) {
    $date = $_POST['date'];
    $bookedSlots = getBookedTimeSlots($conn, $date);
    echo json_encode($bookedSlots);
}
?>
