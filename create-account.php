<?php 
/* Site Under Construction Variable */
$underConstruction = false;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Create Account</title>
	<!-- Start of Bootstrap -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- End of Bootsrap -->
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
		<h1 class="text-center vermillion-color">Create an account</h1><br/>
		<form action="db/signup.php" method="POST">
			<div class="input-group center signUpInput">
				<label for="firstName" class="white-text"><p class="asterix">* </p>First Name:</label>
				<input type="text" name="firstName" id="firstName" class="form-control" required="true">
			</div>
			<div class="input-group center signUpInput">
				<label for="lastName" class="white-text"><p class="asterix">* </p>Last Name:</label>
				<input type="text" name="lastName" id="lastName" class="form-control" required="true">
			</div>
			<div class="input-group center signUpInput">
				<label for="username" class="white-text"><p class="asterix">* </p>Username:</label>
				<input type="text" name="username" id="username" class="form-control" required="true">
			</div>
			<div id="username-short" class="vermillion-color"><small>Username is too short!</small></div>
			<div id="username-taken" class="vermillion-color"><small><img src="media/red-x.png" height="20" width="20" /> Username is taken!</small></div>
			<div id="username-allowed" class="vermillion-color"><small><img src="media/green-check.png" height="20" width="20" /> Username is available!</small></div>
			<div class="input-group center signUpInput">
				<label for="password" class="white-text"><p class="asterix">* </p>Password:</label>
				<input type="password" name="password" id="password" class="form-control" required="true">
			</div>
			<div class="input-group center signUpInput">
				<label for="email" class="white-text">Email:</label>
				<input type="email" name="email" id="email" class="form-control">
			</div>
			<div class="input-group center signUpInput">
				<label for="phone" class="white-text"><p class="asterix">* </p>Phone Number:</label>
				<input type="tel" name="phone" id="phone" class="form-control" placeholder="2075551234" required="true">
			</div>
			<div class="input-group center signUpInput">
				<label for="mall" class="white-text"><p class="asterix">* </p>Mall:</label>
				<select name="mall" class="form-control" required="true">
				  <option value=""></option>
				  <option value="Windham">Windham</option>
				  <option value="Lewiston">Lewiston</option>
				  <option value="Sanford">Sanford</option>
				</select>
			</div>
			<br />
			<small class="asterix">* fields are required.</small>
			<br/><br/>
        	<button name="submit" value="submit" type="submit" id="submitbtn" class="btn btn-success btn-md">Create</button>
		</form>
    	</div>
		<button class="btn vermillion-bg btn-md pull-right"><a href="index.php" class="white-text">Back</a></button>
	</div>
	<script>
    	$(document).ready(function() {
        	var us_taken = $('#username-taken');
        	var us_allowed = $('#username-allowed');
        	var us_short = $('#username-short');
        	var sbtn = $('#submitbtn');
        	us_allowed.hide();
        	us_taken.hide();
        	us_short.hide();
        	sbtn.hide();
        	$('#username').focusout(function(){
            	var username = document.getElementById('username').value;
            	if (username.length > 4) {
                	//username is at least 5 characters
                	//check the db to see if it is taken
                	us_allowed.hide();
                	us_taken.hide();
                	us_short.hide();
                	$.ajax({type: "POST", url: "db/check-username.php", data: {username: username}, success: function(result){
                        if (result) {
                            us_allowed.show();
                            sbtn.show();
                        } else {
                            us_taken.show();
                            sbtn.hide();
                        }
                    }});
            	} else {
                	//username is less than 5 characters
                	//do nothing
                	us_allowed.hide();
                    us_taken.hide();
                    us_short.show();
                    sbtn.hide();
            	}
        	});
        	
    	});
    	
    	
	</script>
</body>
</html>