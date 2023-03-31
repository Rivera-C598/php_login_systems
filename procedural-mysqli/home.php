<?php
session_start();

if (!isset($_SESSION["username"])) {
    // user not logged in, go to login page
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
</head>

<body>
    <h1>welcome
        <?php echo $_SESSION["username"]; ?>
    </h1>
</body>

</html>