<?php
$conn = mysqli_connect("localhost", "root", "", "scheduler");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>