<?php
include 'dbh.php';
date_default_timezone_set('America/New_York');

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$username = $_POST['username'];
$pwd = password_hash($_POST['password'], PASSWORD_BCRYPT, array("cost" => 10));
//$password = $_POST['password'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$mall = $_POST['mall'];
$date = date("m/d/Y @ g:ia");


$sql = "INSERT INTO employees(firstName, lastName, username, password, email, phone, mall, lastLogin) VALUES ('$firstName', '$lastName', '$username', '$pwd', '$email', '$phone', '$mall', '$date')";
echo $sql;
$result = mysqli_query($conn, $sql);
if ($result) {
    //header("Location: ../index.php");
    header("Location: send-email.php?firstName={$firstName}&lastName={$lastName}&username={$username}");
} else {
    echo "Failed to process this request. Please go back and try to submit again.";
}


?>
