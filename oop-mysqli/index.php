<?php
session_start();
//class for database connection
class DatabaseConnection
{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "mydb";
    private $connection;

    public function __construct()
    {
        //create connection
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);
        //if no connection
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }

    }
    //getconnection
    public function getConnection()
    {
        return $this->connection;
    }
}

//login class, authenticates users to the database
class Login
{
    
    private $connection;

    public function __construct($database_connection)
    {
        $this->connection = $database_connection->getConnection();
    }

    public function authenticate($username, $password)
    {
        $query = "SELECT * FROM users WHERE username = '$username' AND pass = '$password'";
        $result = $this->connection->query($query);

        if ($result->num_rows == 1) {
            return true;
        } else {
            return false;
        }
    }
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $database_connection = new DatabaseConnection();
    $login = new Login($database_connection);

    if ($login->authenticate($username, $password)) {
        $_SESSION['username'] = $username;
        header('Location: home.php');
    } else {
        $error_message = "Invalid username or password";
    }
}
?>
    
<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
</head>
<body>
    <h1>Login Page</h1>
    <?php if (isset($error_message)): ?>
        <p>
            <?php echo $error_message; ?>
        </p>
    <?php endif; ?>
    <form method="post" action="">
        <label>Username</label>
        <input type="text" name="username"><br><br>
        <label>Password</label>
        <input type="password" name="password"><br><br>
        <input type="submit" name="submit" value="Login">
    </form>
</body>

</html>