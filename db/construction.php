<?php
include 'dbh.php';

$val = $_POST['val'];

$sql = "UPDATE underConstruction SET value='$val' WHERE id=1";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo true;
} else {
    echo $sql;
}
    
?>