<?php
session_start();
include 'dbh.php';

$username = $_POST['username'];
$password1 = $_POST['password1'];
$password2 = $_POST['password2'];
$ver = $_POST['ver'];

if ($password1 == $password2) {
	//passwords match
	if ($ver != "1482983673") {
		//Verification code is incorrect
		$_SESSION['ver-alert'] = true;
		$_SESSION['username-alert'] = false;
		$_SESSION['pass-alert'] = false;
		header("Location: ../reset-pass.php");
	}
    
    $pwd = password_hash($password1, PASSWORD_BCRYPT, array("cost" => 10));
	$sql = "UPDATE employees SET password='$pwd' WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    header("Location: ../index.php");

} else {
	//they do not match
	$_SESSION['pass-alert'] = true;
	$_SESSION['ver-alert'] = false;
	$_SESSION['username-alert'] = false;
	header("Location: ../reset-pass.php");
}

?>