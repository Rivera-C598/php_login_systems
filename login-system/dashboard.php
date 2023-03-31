<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

// You can customize this page to display any information or functionality that is available for logged-in users

$user_id = $_SESSION['user_id'];

require_once 'db.php';

$stmt = $db->prepare('SELECT * FROM users WHERE id = :user_id');
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="dashboard-container">
        <h2>Welcome, <?php echo $user['username']; ?>!</h2>
        <p>You are logged in.</p>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
