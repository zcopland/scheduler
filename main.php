<?php
session_start();
$isAdmin = $_SESSION['isAdmin'];
$mall = $_SESSION['mall'];
if (!isset($_SESSION['mall'])  || empty($_SESSION['mall'])) {
    header('Location: index.php');
}
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

/* Version Variable */
$version = 2.0;

?>

<!DOCTYPE html>
<html>
<head>
	<title>Schedule</title>
	<meta charset='utf-8' />
	<!-- Start of Bootstrap -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- End of Bootsrap -->
    <!-- Start of FullCalendar -->
    <link rel='stylesheet' href='//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css'/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script src='fullcalendar/moment.js'></script>
	<script src='//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
	<!-- End of FullCalendar -->
	<script type="text/javascript" src="script.js"></script>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<link rel="stylesheet" type="text/css" href="main-styles.css">
</head>
<body>
<?php if ($underConstruction): ?>
    <!-------- SITE UNDER CONSTRUCTION ALERT -------->
    <div class="alert alert-warning alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Warning!</strong> Site is currently being worked on
    </div>
    <script>alert("Warning! Site is currently being worked on.");</script>
    <!-------- SITE UNDER CONSTRUCTION ALERT -------->
<?php endif; ?>

<!-- CALENDAR DIV -->
	<?php if (isset($_SESSION['mall'])) { ?>
    <h1 class="text-center"><?php echo $_SESSION['mall']; ?> Schedule</h1>
    <?php } ?>
    <div id='wrap'>
<?php 
if ($isAdmin) {
	echo <<<HTML
		<!--div class="input-group">
			<select name="mall" class="form-control" required="true">
			  <option value="Windham">Windham</option>
			  <option value="Lewiston">Lewiston</option>
			  <option value="Sanford">Sanford</option>
			</select>
		</div><br/-->
		<div id='external-events'>
			<h4 class="drag-label">Drag a new shift</h4>
			<div class='fc-event'>New Shift</div>
			<p>
				<img src="media/trash.png" style="width:43px;height:55px;" id="trash" alt="">
			</p><br/><br/>
			<div class="notifyDiv"><button class="btn vermillion-bg text-left notify"><a class="white-text" href="send-text.php">Notify</a></button></div>
			<div class="delete-group">
		    <h4 class="vermillion-color">Archive shifts older than:</h4>
		    <select id="delete-month" name="delete-month" class="blue-color">
		      <option value="null">--</option>
		      <option value="30">1 month</option>
		      <option value="60">2 months</option>
		      <option value="90">3 months</option>
		    </select><br/><br/>
		    <button id="deleteBtn" class="btn-sm btn-danger">Archive</button>
            </div>
		</div>
		
		
HTML;
}
?>
		<div class="text-center"><div id='calendar'></div></div>
		<div style='clear:both'></div>
	</div>
<!-- PHP FOR NON-ADMINS -->
<?php 
if (!$isAdmin) {
	echo <<<HTML
<br/>
<div class="container">
	<button class="btn pull-left vermillion-bg"><a class="white-text" href="mailto:zcopland16@gmail.com?subject=Scheduler Site">Contact Support</a></button>
	<button class="btn pull-right vermillion-bg"><a class="white-text" href="mailto:jay@wrebrokers.com">Contact Jay Wise</a></button>
</div>
HTML;
}
?>
<!-- END OF PHP FOR NON-ADMINS -->

<div class="isAdmin" style="display: none;"><?php echo $isAdmin; ?></div>

<!-- PHP FOR ADMIN STUFF -->
<?php
if ($isAdmin) {
	echo <<<HTML
<br/>
<div class="contianer">
<div>
  <label id="underConstructionLabel" for="underConstruction">Under Contsruction</label>
HTML;
if ($val == 1) {
    echo '<input type="checkbox" checked="true" id="underConstruction" name="underConstructon"/>';
} else if ($val == 0) {
    echo '<input type="checkbox" id="underConstruction" name="underConstructon"/>';
} 
echo <<<HTML
</div>
<button class="btn vermillion-bg" type="submit" id="showEmployees" name="showEmployees">Employee Contact List</button>
</div>
<br/><br/>
HTML;

	$query = "SELECT * FROM employees";
	$result = mysqli_query($conn, $query);
	echo "<div id=\"employee-list\" class=\"container table-responsive\"><table class='table table-hover'><tr><th>Name</th><th>Email</th><th>Phone</th><th>Mall</th><th>Last Login</th></tr>";
	while ($row = mysqli_fetch_assoc($result)) { 
		echo <<<TEXT
<tr>
  <td>{$row["firstName"]}  {$row["lastName"]}</td>
  <td>{$row['email']}</td>
  <td>{$row['phone']}</td>
  <td>{$row['mall']}</td>
  <td>{$row['lastLogin']}</td>
TEXT;
    }
    echo "</tr></table></div>";

} 
?>
<!-- END OF PHP FOR ADMIN STUFF -->
<footer class="text-center">Copyright Zach Copland <?php echo date("Y"); ?>. Version: <?php echo $version; ?></footer>
<script type="text/javascript">
$(document).ready(function() {
  $('#employee-list').hide();
  //toggling the employee list
  $('#showEmployees').click(function() {
    $('#employee-list').toggle(1000);
  });
  $('#deleteBtn').click(function() {
      var val = $('#delete-month').val();
      if (val != 'null') {
          if (confirm("Are you sure you want to archive shifts older than " + val + " days?") == true) {
            $.ajax({
                type: "POST",
                url: "db/delete.php",
                data: {val: val},
                success: function(result){
                    if (result) {
                        alert("Success! Shifts older than " + val + " days have been archived!");
                        window.location.href = "main.php";
                    } else {
                        console.log("Query: " + result);
                    }
                }
            });
          } else {$('#delete-month').val("")}
      } else {
          alert("Please select a range to delete from!");
      }
  });
  $('#underConstruction').click(function() {
      var val;
      if ($('#underConstruction').prop('checked') == true) {
          val = 1;
      } else {
          val = 0;
      }
      $.ajax({
        type: "POST",
        url: "db/construction.php",
        data: {val: val},
        success: function(result){
            if (result) {
                console.log("Success!");
                //window.location.href = "main.php";
            } else {
                console.log("Query: " + result);
            }
        }
    });
  });
});
</script>
</body>
</html>