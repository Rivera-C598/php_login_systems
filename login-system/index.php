<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <form method="POST" action="login.php">
            <h2>Login</h2>
            <?php if (isset($_GET['error'])) { ?>
                <p class="error">
                    <?php echo $_GET['error']; ?>
                </p>
            <?php } ?>
            <?php if (isset($_SESSION['success_message'])) { ?>
                <p class="success">
                    <?php echo $_SESSION['success_message']; ?>
                </p>
                <?php unset($_SESSION['success_message']); ?>
            <?php } ?>
            <label>Username</label>
            <input type="text" name="username" required>
            <label>Password</label>
            <input type="password" name="password" required>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Register here</a>.</p>
    </div>
</body>

</html>