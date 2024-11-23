<?php

session_start();

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "calorie_tracker";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $weight = trim($_POST['weight']);
    $height = trim($_POST['height']);
    $age = trim($_POST['age']);
    $gender = $_POST['gender'];

   
    if (empty($username) || empty($email) || empty($password) || empty($weight) || empty($height) || empty($age) || empty($gender)) {
        $_SESSION['error'] = "Please fill in all required fields.";
        header("Location: 1REGISTER.php");
        exit();
    }

    $sql_check_user = "SELECT * FROM user WHERE username = ?";
    $stmt_check = $conn->prepare($sql_check_user);
    $stmt_check->bind_param("s", $username);
    $stmt_check->execute();
    $result = $stmt_check->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['error'] = "Username already exists.";
        header("Location: 1REGISTER.php");
        exit();
    }

    $sql_check_email = "SELECT * FROM user WHERE email = ?";
    $stmt_check_email = $conn->prepare($sql_check_email);
    $stmt_check_email->bind_param("s", $email);
    $stmt_check_email->execute();
    $result_email = $stmt_check_email->get_result();

    if ($result_email->num_rows > 0) {
        $_SESSION['error'] = "Email already exists.";
        header("Location: 1REGISTER.php");
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO user (username, email, password, weight, height, age, gender) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ssdiiss", $username, $email, $hashed_password, $weight, $height, $age, $gender);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Registration successful!";
        header("Location: login.php"); 
        exit();
    } else {
        $_SESSION['error'] = "Error: " . $stmt->error;
        header("Location: 1REGISTER.php");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
