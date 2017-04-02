<?php
session_start(); //starting session
//setting variable to false until they log in
$_SESSION['id'] = '';
$_SESSION['username'] = '';

include 'db/dbh.php';

/* Site Under Construction Variable */
$query = "SELECT * FROM underConstruction WHERE id=1";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)) {
   $val =  $row['value'];
}
if ($val == 1) {
    $underConstruction = true;
} else if ($val == 0) {
    $underConstruction = false;
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Scheduler</title>
	<!-- Start of Bootstrap -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- End of Bootsrap -->
    <link rel="stylesheet" type="text/css" href="styles.css">
	<script type="text/javascript" src="script.js"></script>
</head>
<body>
	</br></br>
    <h1 class="text-center">Please Log in</h1><br/><br/>
    <div class="container">
      <h2 class="text-center">Credentials</h2>
<!-- Password Alert -->
<?php
if (isset($_SESSION['pass-alert-index']) && $_SESSION['pass-alert-index'] == true) {
    echo <<<HTML
    <div class="alert alert-warning alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Warning!</strong> Password incorrect.
    </div>
HTML;
}
?>
<!-- Password Alert -->
<?php if ($underConstruction): ?>
    <!-------- SITE UNDER CONSTRUCTION ALERT -------->
    <div class="alert alert-warning alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Warning!</strong> Site is currently being worked on
    </div>
    <!-------- SITE UNDER CONSTRUCTION ALERT -------->
<?php endif; ?>
      <form method="POST" class="loginForm" action="db/login.php">
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input id="username" type="text" class="form-control" name="username" placeholder="Username" autofocus="true" required="true">
        </div><br/>
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input id="password" type="password" class="form-control" name="password" placeholder="Password" required="true">
        </div><br/><br/>
        <button name="submit" value="submit" type="submit" class="btn btn-primary btn-md">Log in</button>
      </form>
      <button class="btn vermillion-bg btn-md pull-right"><a href="create-account.php" class="white-text">Create Account</a></button>
      <br/><br/>
      <button class="btn btn-info btn-md pull-right"><a href="reset-pass.php" class="white-text">Reset Password</a></button>
      </div>
</body>
</html>