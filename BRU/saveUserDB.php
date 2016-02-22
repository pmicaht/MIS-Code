<?php
session_start();

if (! isset($_SESSION['validemail'])) {
	//invalid user
	echo "<div style = 'font:16px;color:#ff0000'>You must be logged in to use this system.</div><br>";
	echo "Please use the <a href='SystemMenu.php'>login page.</a><br>";
	
	exit;
}
?>
<html>
<body>
<!--Create form used to insert employee info into the database-->
<form action="saveUserDB.php" method="POST">
  First name:<br>
  <input type="text" name="firstname"><br><br>
  Last name:<br>
  <input type="text" name="lastname"><br><br>
  Email Address:<br>
  <input type="text" name="email"><br><br>
  Phone Number:<br>
  <input type="text" name="phone"><br><br>
  Employee ID:<br>
  <input type="text" name="empID"><br><br>
  <input type="submit" value="Submit">
</form><br><br>

<!--PHP script-->
<?php
//Login info used for the PDO connection
$servername = "localhost";
$dbname = "mtMIS419EmployeeDB";
$username = "mtMIS419";
$password = "895623";

//to retrieve the incoming form's data from the $_POST array
$tFirst = $_POST['firstname'];
$tLast = $_POST['lastname'];
$tPhone = $_POST['phone'];
$tEmail = $_POST['email'];
$tID = $_POST['empID'];

//connect and insert form data into mysql database
if ($tFirst > "" && $tLast > "") {
	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//echo "Connected successfully!"; 
		
		$sql = "INSERT INTO Employee (Emp_FirstName, Emp_LastName, Emp_Phone, Emp_Email, Emp_ID) VALUES ('" . $tFirst . "', '" . $tLast ."', '" . $tPhone . "', '" . $tEmail . "', '" . $tID . "')";
		
		//echo "<h2>".$sql."</h2>";
		
		// use exec() because no results are returned
		$conn->exec($sql);
		echo "<br><br>The employee $tID-- $tLast, $tFirst has been saved.<br><br><br>";
	}
	catch(PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
	}
}	
//Close PHP script
?>

<a href="SystemMenu.php">Go back to Main menu</a href>

</body>
</html>

