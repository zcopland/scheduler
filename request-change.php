<?php
include 'db/dbh.php';
/* Site Under Construction Variable */
$underConstruction = false;

if (!isset($_GET['firstName'])) {
    header("Location: main.php");
}

$firstName = $_GET['firstName'];
$lastName = $_GET['lastName'];
$username = $_GET['username'];
$email = $_GET['email'];
$id = $_GET['id'];
$mall = $_GET['mall'];

?>

<!DOCTYPE html>
<html>
<head>
	<title>Request Change</title>
	<!-- Start of Bootstrap -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- End of Bootsrap -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
    <link href="datepicker.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<?php if ($underConstruction): ?>
    <!-------- SITE UNDER CONSTRUCTION ALERT -------->
    <div class="alert alert-warning alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Warning!</strong> This page is currently under construction
    </div>
    <!-------- SITE UNDER CONSTRUCTION ALERT -------->
<?php endif; ?>
	<div class="container">
    	<div id="signUpDiv" class="text-center grey-background center">
		<h1 class="text-center vermillion-color">Request a schedule change</h1><br/>
		<form action="request-change-action.php" method="POST">
			<div class="input-group center signUpInput">
				<label for="firstName" class="white-text"><p class="asterix">* </p>First Name:</label>
				<input type="text" name="firstName" value=<?php echo $firstName; ?> id="firstName" class="form-control" readonly="true" />
			</div>
			<div class="input-group center signUpInput">
				<label for="lastName" class="white-text"><p class="asterix">* </p>Last Name:</label>
				<input type="text" name="lastName" value=<?php echo $lastName; ?> id="lastName" class="form-control" readonly="true" />
			</div>
			<div class="input-group center signUpInput">
				<label for="username" class="white-text"><p class="asterix">* </p>Username:</label>
				<input type="text" name="username" value=<?php echo $username; ?> id="username" class="form-control" readonly="true" />
			</div>
			<div class="input-group center signUpInput">
				<label for="email" class="white-text">Email:</label>
				<input type="email" name="email" value=<?php echo $email; ?> id="email" class="form-control" readonly="true" />
			</div>
			<div class="input-group center signUpInput">
				<label for="desired-action" class="white-text"><p class="asterix">* </p>Desired Action:</label>
				<select name="desired-action" id="desired-action" class="form-control" required="true">
				  <option value="">Select Action</option>
				  <option value="Swap Shift">Swap Shift</option>
				  <option value="Time Off">Request Time Off</option>
				  <option value="Other">Other</option>
				</select>
			</div>
			<div class="input-group center signUpInput">
				<label for="lastName" class="white-text"><p class="asterix">* </p>Desired Date</label>
				<input type="text" name="desired-date" id="datepicker" class="form-control" required="true" />
			</div>
			<input type="hidden" name="mall" value=<?php echo $mall; ?> />
			<div id="swap-shifts" class="input-group center signUpInput">
				<label for="employees" class="white-text"><p class="asterix">* </p>Swap shifts with:</label>
				<select name="employees" class="form-control">
				  <option value=""></option>
<?php
  $query = "SELECT * FROM employees WHERE mall='{$mall}'";
  $result = mysqli_query($conn, $query);
	while ($row = mysqli_fetch_assoc($result)) {
    	if ($row['id'] != $id && $row['isAdmin'] == 0) {
        	echo  <<<TEXT
        	<option value="{$row['firstName']} {$row['lastName']}">{$row['firstName']} {$row['lastName']}</option>
TEXT;
    	}
    }
  
?>
				</select>
			</div>
			<div class="input-group center signUpInput">
				<label for="lastName" class="white-text"><p class="asterix">* </p>Reason</label>
				<textarea name="reason" id="reason" class="form-control" required="true"></textarea>
			</div>
			<br />
			<small class="asterix">* fields are required.</small>
			<br/><br/>
        	<button name="submit" value="submit" type="submit" id="submitbtn" class="btn btn-success btn-md">Submit</button>
		</form>
    	</div>
		<button class="btn vermillion-bg btn-md pull-right"><a href="index.php" class="white-text">Back</a></button>
	</div>
	<script>
    	$(document).ready(function() {
        	$('#datepicker').datepicker({
				inline: true,
				showOtherMonths: true,
				dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
			});
        	$('#swap-shifts').hide();
        	$('#desired-action').change(function() {
            	if ($(this).val() == 'Swap Shift') {
                	$('#swap-shifts').show(400);
            	} else {
                	$('#swap-shifts').hide(400);
            	}
        	});
        });
	</script>
</body>
</html>