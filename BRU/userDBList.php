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

<head>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">

<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.0.min.js">
</script>
	
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js">
</script>
	
<script type="text/javascript" class="init">	
$(document).ready(function() {
	$('#emptable').DataTable();
} );
</script>
	
</head>

<body>
<table id="emptable" class="display" cellspacing="0" width="100%">
<thead><tr><th align="left">ID</th><th align="left">Last Name</th><th align="left">First Name</th><th align="left">Email</th><th align="left">Phone</th></tr></thead><tbody>
<?php
$servername = "localhost";
$dbname = "mtMIS419EmployeeDB";
$username = "mtMIS419";
$password = "895623";


	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//echo "Connected successfully!"; 
		
				
		
		$stmt = $conn->query('SELECT * FROM Employee ORDER BY Emp_Lastname');
		 
		while($emprow = $stmt->fetch(PDO::FETCH_ASSOC)) {
			echo "<tr><td>"
			. $emprow['Emp_ID']
			. '</td><td>'
			. $emprow['Emp_Lastname']
			. '</td><td>'
			. $emprow['Emp_Firstname']
			. '</td><td>' 
			. $emprow['Emp_Email']
			. '</td><td>'
			. $emprow['Emp_Phone']
			. "</td></tr>";
		}
		

	}
	catch(PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
	}

?>
</tbody></table>

<a href="SystemMenu.php">Go back to Main menu</a href>
</body>

</html>

