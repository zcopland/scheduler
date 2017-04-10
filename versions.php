<?php
    
/* Version Variable */
$version = '2.1.3';

?>
<!DOCTYPE html>
  <head>
    <title>Versions</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
  </head>
  <body>
    <h1>Versions</h1>
    <h2>Current version: <?php echo $version; ?></h2>
    <table class="table">
        <tr><th>Version</th><th>Update</th></tr>
        <tr><td>2.1.3</td><td>Added a version page.</td></tr>
        <tr><td>2.1.2</td><td>Added a logout button.</td></tr>
        <tr><td>2.1.1</td><td>Added a redirect from index to main.</td></tr>
        <tr><td>2.1.0</td><td>Phone numbers & emails generate from database.</td></tr>
        <tr><td>2.0.0</td><td>Implemented emailing function</td></tr>
        <tr><td>1.9.0</td><td>Added under construction checkbox.</td></tr>
        <tr><td>1.8.0</td><td>Centered calendar on larger screens.</td></tr>
        <tr><td>1.7.0</td><td>Created a "last logged in" field in database.</td></tr>
        <tr><td>1.6.0</td><td>Added version numbers to main page.</td></tr>
        <tr><td>1.5.0</td><td>Added option to delete shifts older than specific months.</td></tr>
        <tr><td>1.4.0</td><td>Added phone numbers dynamically to notify page.</td></tr>
        <tr><td>1.3.0</td><td>Checks usernames using AJAX before creating account.</td></tr>
        <tr><td>1.2.0</td><td>Fixed mobile view.</td></tr>
        <tr><td>1.1.0</td><td>Added employee list to admin view on main.</td></tr>
        <tr><td>1.0.0</td><td></td></tr>
    </table>
  </body>
</html>