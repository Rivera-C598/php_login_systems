<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once 'db.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id, username, pass_word FROM users WHERE username = :username";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['pass_word'])) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: dashboard.php');
        exit;
    } else {
        header('Location: index.php?error=Incorrect username or password');
        exit;
    }
}
?>