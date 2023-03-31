<?php
//connect database
$conn = mysqli_connect('localhost', 'root', '', 'mydb');
//if submit button clicked
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    //query
    $query = "SELECT * FROM users WHERE username ='$username' AND pass='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        session_start();
        $_SESSION["username"] = $username;
        header("Location: home.php");
    } else {
        echo "Invalid username or password";
    }
}
?>

<html>

<head>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h2>Login</h2>
    <form method="post" action="">
        Username: <input type="text" name="username"><br>
        Password: <input type="password" name="password"><br>
        <input type="submit" name="submit" value="Login">
    </form>
    </div>
</body>

</html>