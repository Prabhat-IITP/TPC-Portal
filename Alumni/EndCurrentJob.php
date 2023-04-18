<?php
// Start session to access logged in user's information
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "iitp_tpc";
$conn = new mysqli($servername, $username, $password, $dbname);
// Retrieve user's first name and last name from database
$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT * FROM alumni_company_details WHERE alumni_id = '$user_id' AND months_worked = 'Ongoing'");
if(mysqli_num_rows($result) == 0)
{
  echo " You have no ongoing job.";
  exit();
}
$row = $result->fetch_assoc();
$_SESSION['company_name'] = $row['company_name'];
$_SESSION['joining_date'] = $row['joining_date'];
// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
  <title>Dashboard</title>
  <link rel="stylesheet" type="text/css" href="style2.css">
</head>

<body>
  <div class="container">
    <h1>When did you end your job at <span><?php echo $_SESSION['company_name']; ?></span></h1>
    <form method="post" action="UpdateOngoing.php">
		<label for="input_date">Enter date: </label>
		<input type="date" id="input_date" name="input_date">
		<input type="submit" name="submit" value="Submit">
	</form>
  </div>

</body>

</html>