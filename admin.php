<?php
include 'config.php';
session_start();
if ($_SESSION['user']['role'] != 'admin') {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $name = $_POST['name'];
    $extra = $_POST['extra'];

    $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $password, $role);
    $stmt->execute();
    $user_id = $stmt->insert_id;

    if ($role == 'student') {
        $stmt2 = $conn->prepare("INSERT INTO students (user_id, name, class) VALUES (?, ?, ?)");
        $stmt2->bind_param("iss", $user_id, $name, $extra);
    } else {
        $stmt2 = $conn->prepare("INSERT INTO teachers (user_id, name, subject) VALUES (?, ?, ?)");
        $stmt2->bind_param("iss", $user_id, $name, $extra);
    }
    $stmt2->execute();
    echo "<p>User added successfully!</p>";
}
?>

<h2>Admin Dashboard</h2>
<form method="POST">
    Username: <input name="username" required><br><br>
    Password: <input name="password" required><br><br>
    Role: 
    <select name="role">
        <option value="student">Student</option>
        <option value="teacher">Teacher</option>
    </select><br><br>
    Name: <input name="name" required><br><br>
    Class (for student) or Subject (for teacher): <input name="extra" required><br><br>
    <button type="submit">Create Account</button>
</form>
<a href="logout.php">Logout</a>
