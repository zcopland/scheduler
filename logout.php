<?php
session_start();
$_SESSION['isAdmin'] = false;
$_SESSION['mall'] = '';
session_destroy();
header("Location: index.php");
?>