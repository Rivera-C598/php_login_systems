<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once 'db.php';

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, email, pass_word, created_at) VALUES (:username, :email, :pass_word, NOW())";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':pass_word', $password);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Your account has been created successfully! Please log in.";
        header('Location: index.php');
        exit;
    } else {
        header('Location: register.php?error=Registration failed');
        exit;
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Registration Page</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <form method="POST" action="register.php">
            <h2>Register</h2>
            <?php if (isset($_GET['error'])) { ?>
                <p class="error">
                    <?php echo $_GET['error']; ?>
                </p>
            <?php } ?>
            <label>Username</label>
            <input type="text" name="username" required>
            <label>Email</label>
            <input type="email" name="email" required>
            <label>Password</label>
            <input type="password" name="password" required>
            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="index.php">Login here</a>.</p>
    </div>
</body>

</html>