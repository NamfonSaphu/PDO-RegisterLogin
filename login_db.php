<?php
session_start();
require('config.php');

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
}

if (empty($email)) {
    $_SESSION['error'] = "Please enter your email";
    header("location: login.php");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = "Please enter a valid email address";
    header("location: login.php");
} else if (empty($password)) {
    $_SESSION['error'] = "Please enter your password";
    header("location: login.php");
} else {
    try {
        // check email
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $userData = $stmt->fetch();

        if ($userData && password_verify($password, $userData['password'])) {
            $_SESSION['user_id'] = $userData['id'];
            header("location: dashboard.php");
        } else {
            $_SESSION['error'] = "Invalid email or password";
            header("location: login.php");
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "Something went wrong, Please try again";
        header("location: login.php");
    }
}
