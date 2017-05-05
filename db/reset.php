<?php
session_start();
include 'dbh.php';

$username = $_POST['username'];
$password1 = $_POST['password1'];
$password2 = $_POST['password2'];
$email = $_POST['email'];
$phone = $_POST['phone'];

if ($password1 == $password2) {
	$sql = "SELECT * FROM `employees` WHERE `username`='{$username}' AND `email`='{$email}' AND `phone`='{$phone}';";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
    if ($row > 0) {
        /* found row, now update password */
        $id = $row['id'];
        $pwd = password_hash($password1, PASSWORD_BCRYPT, array("cost" => 10));
    	$sql = "UPDATE employees SET password='{$pwd}' WHERE id={$id};";
        $result2 = mysqli_query($conn, $sql);
        if ($result2) {
            $_SESSION['ver-alert'] = false;
    		$_SESSION['username-alert'] = false;
    		$_SESSION['pass-alert'] = false;
            header("Location: ../index.php");
        }
        
    } else if ($row <= 0) {
        /* could not find email or phone */
        $_SESSION['ver-alert'] = true;
		$_SESSION['username-alert'] = false;
		$_SESSION['pass-alert'] = false;
		header("Location: ../reset-pass.php");
    }

} else {
	/* passwords do not match */
	$_SESSION['pass-alert'] = true;
	$_SESSION['ver-alert'] = false;
	$_SESSION['username-alert'] = false;
	header("Location: ../reset-pass.php");
}

?>