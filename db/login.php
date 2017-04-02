<?php
session_start();
$_SESSION['loggedIn'] = false;
date_default_timezone_set('America/New_York');
include 'dbh.php';

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM employees WHERE username='$username'";
$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);

if (password_verify($password, $row['password'])) {
    //Correct
    $date = date("m/d/Y @ g:ia");
    $sql = "UPDATE employees SET lastLogin='$date' WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    $_SESSION['loggedIn'] = true;
    $_SESSION['incorrect'] = false;
    $_SESSION['pass-alert-index'] = false;
    $_SESSION['id'] = $row['id'];
    $_SESSION['mall'] = $row['mall'];
    $_SESSION['isAdmin'] = $row['isAdmin'];
    header("Location: ../main.php");
} else  {
    //Incorrect
    $_SESSION['loggedIn'] = false;
    $_SESSION['incorrect'] = true;
    $_SESSION['pass-alert-index'] = true;
    header("Location: ../index.php");
}

/*
    For Development:
    jalbert: 11111
    mlittle: 12345
*/

?>