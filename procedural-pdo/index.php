<?php
session_start();
//use pdo through try catch block
try {
    $pdo = new PDO("mysql:host=localhost;dbname=mydb;charset=utf8mb4", "root", "");
    //catch errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->query("SELECT * FROM users WHERE username='$username' AND pass='$password'");
    $user = $stmt->fetch();

    if ($user) {
        $_SESSION['username'] = $user['username'];
        header('Location: home.php');
        exit;
    } else {
        $error = "Invalid username or password";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <?php if (isset($error)) { ?>
        <div class="error"><?php echo $error; ?></div>
    <?php } ?>
    <form method="post">
        <label>Username:</label>
        <input type="text" name="username" required>
        <br>
        <label>Password:</label>
        <input type="password" name="password" required>
        <br>
        <input type="submit" value="Login">
    </form>
</body>
</html>