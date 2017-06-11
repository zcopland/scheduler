<?php
    
include 'db/dbh.php';
    
if (!isset($_POST['firstName'])) {
    header("Location: main.php");
}

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$username = $_POST['username'];
$email = $_POST['email'];
$action = $_POST['desired-action'];
$date = $_POST['desired-date'];
$mall = $_POST['mall'];
$withEmployee = '';
if (isset($_POST['employees'])) {
    $withEmployee = $_POST['employees'];
}
$reason = $_POST['reason'];
$to = '';

$query = "SELECT * FROM employees WHERE mall='{$mall}' AND isAdmin=1";
$result = mysqli_query($conn, $query);
$index = 0;
while ($row = mysqli_fetch_assoc($result)) {
    if ($index == 0) {
        $to .= $row['email'];
    } else {
        $to .= ',' . $row['email'];
    }
    $index++;
}

$subject = 'Request for Schedule Change';
$body = <<<TEXT
Hello,

{$firstName} {$lastName} ({$username}) from the {$mall} Mall has requested {$action} for {$date}.

TEXT;

if (!empty($withEmployee)) {
    $body .= "{$firstName} would like to swap shifts with {$withEmployee}.\n";
}

$body .= <<<TEXT
Reason: 
    {$reason}
TEXT;
$headers = "From: {$email}";

if (mail($to, $subject, $body, $headers)) {
    //success
  echo <<<HTML5
<p>Success! Your request has been sent to administrators.</p>
<a href="main.php">Take me Home</a>
HTML5;
} else {
    //failed
  echo <<<HTML5
<p>Failure! Your request was unable to be sent to administrators. Please try again.</p>
<a href="main.php">Take me Home</a>
HTML5;
}

?>