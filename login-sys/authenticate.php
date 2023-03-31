<?php
$users = array(
	"john" => "pass123"
);

$username = $_POST["username"];
$password = $_POST["password"];

if (isset($users[$username]) && $users[$username] == $password) {
	// login successful
	session_start();
	$_SESSION["username"] = $username;
	header("Location: dashboard.php");
} else {
	// login failed
	header("Location: login.php?error=1");
}
?>