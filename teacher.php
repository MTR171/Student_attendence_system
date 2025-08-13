<?php
include 'config.php';
session_start();
if ($_SESSION['user']['role'] != 'teacher') {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = $_POST['student_id'];
    $month = $_POST['month'];
    $present = $_POST['present'];
    $total = $_POST['total'];

    $stmt = $conn->prepare("REPLACE INTO attendance (student_id, month, present_days, total_days) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isii", $student_id, $month, $present, $total);
    $stmt->execute();
    echo "<p>Attendance updated!</p>";
}
?>

<h2>Teacher Dashboard</h2>
<form method="POST">
    Student ID: <input name="student_id"><br><br>
    Month: <input name="month"><br><br>
    Present Days: <input name="present"><br><br>
    Total Days: <input name="total"><br><br>
    <button type="submit">Submit</button>
</form>
<a href="logout.php">Logout</a>
