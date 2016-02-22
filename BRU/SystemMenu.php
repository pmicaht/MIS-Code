<?php
session_start();
?>
<html>
<body>
<?php

if ($_POST['Femailaddress'] > "") {
	//if set, then process their login by looking up in database
		$servername = "localhost";
		$dbname = "mtMIS419EmployeeDB";
		$username = "mtMIS419";
		$password = "895623";


			try {
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				// set the PDO error mode to exception
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				//echo "Connected successfully!"; 
				
				$tempEmail = $_POST['Femailaddress'];
				$tempPword = $_POST['Fpassword'];
				
				$sql = 'SELECT * FROM ValidUsers WHERE User_Email="'.$tempEmail.'" AND User_Password = "'.$tempPword.'" ';
				
				$stmt = $conn->query($sql);
				 
				$matchFound = false;
				while($emprow = $stmt->fetch(PDO::FETCH_ASSOC)) {
					$matchFound = true;
				}
				
				if($matchFound) {
					$_SESSION['validemail'] = $tempEmail;
				} else {
					echo "<div style = 'font:16px;color:#ff0000'>*Invalid Login*<br><br>";
				}
				
			}
			catch(PDOException $e) {
				echo "Connection failed: " . $e->getMessage();
			}
	
} //end if($_POST[''])

if (isset($_SESSION['validemail'])) {
	//valid user
?>
<h2>Employee System Menu</h2>
<ul>
	<li><a href="saveUserDB.php">Add New Employee</a></li>
	<li><a href="userDBList.php">View All Employees</a><br><br>&nbsp;</li>
	<li><a href="logout.php">Log Out</a></li>
</ul>
<?php
} else {
	//not logged in yet
?>
Please enter the following credentials:<br>
<br>
<form action="SystemMenu.php" method="POST">
Email Address:<input type="text" name="Femailaddress"><br>
Password:<input type="password" name="Fpassword"><br>
<input type="submit">
</form>
<?php	
}

?>

</body>
</html>