<?php
include 'config.php';
session_start();
if ($_SESSION['user']['role'] != 'student') {
    header("Location: index.php");
    exit;
}

$user_id = $_SESSION['user']['id'];
$res = $conn->query("SELECT id FROM students WHERE user_id = $user_id");
$student_id = $res->fetch_assoc()['id'];

$result = $conn->query("SELECT * FROM attendance WHERE student_id = $student_id");
?>

<h2>Your Attendance</h2>
<table border="1">
<tr><th>Month</th><th>Present</th><th>Total</th></tr>
<?php while($row = $result->fetch_assoc()) { ?>
<tr>
    <td><?= $row['month'] ?></td>
    <td><?= $row['present_days'] ?></td>
    <td><?= $row['total_days'] ?></td>
</tr>
<?php } ?>
<a href="logout.php">Logout</a>
