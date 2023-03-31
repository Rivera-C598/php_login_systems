<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
</head>

<body>
    <?php
    if (isset($_POST['login'])) {
        //connect to database
        $mysqli = new mysqli("localhost", "root", "", "mydb");

        //check connection
        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli->connect_error;
            exit();
        }

        //sanitize user input
        $username = $mysqli->real_escape_string($_POST['username']);
        $password = $mysqli->real_escape_string($_POST['password']);

        //query the database
        $query = "SELECT * FROM users WHERE username='$username' AND pass='$password'";
        $result = $mysqli->query($query);

        //if there is user go to homepage
        if ($result->num_rows == 1) {
            header("Location: home.php");
            exit();
        } else {
            //if user not found
            echo "Invalid username or password";
        }
        $mysqli->close();
    }
    ?>

    <form method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>

        <input type="submit" name="login" value="Login">
    </form>
</body>

</html>