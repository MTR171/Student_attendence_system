<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
$role = $_SESSION['user']['role'];
switch ($role) {
    case 'admin': header("Location: admin.php"); break;
    case 'teacher': header("Location: teacher.php"); break;
    case 'student': header("Location: student.php"); break;
}
?>
