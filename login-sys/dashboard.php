<?php
session_start();

if (!isset($_SESSION["username"])) {
	// user not logged in, redirect to login page
	header("Location: login.php");
	exit();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
</head>
<body>
	<h2>Welcome, <?php echo $_SESSION["username"]; ?></h2>
	<p>This is the dashboard page. You must be logged in to see this.</p>
</body>
</html>