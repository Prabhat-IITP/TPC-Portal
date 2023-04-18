
<!DOCTYPE html>
<html>

<head>
  <title>Dashboard</title>
  <link rel="stylesheet" type="text/css" href="style5.css">
</head>
<body>
<div class="card-deck">
<?php
session_start();
function redirect($url)
{
    header('Location: '.$url);
    exit();
}
$CompanyName = $_SESSION['company_name'];
  // Connect to the database
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "iitp_tpc";
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  // Query the database for the user's information
  $sql = "SELECT * FROM alumni_company_details as a  natural join alumni_details as b WHERE company_name ='$CompanyName' AND a.alumni_id = b.id";
  $result = $conn->query($sql);
 // Loop through the data and display it in cards
 while ($row = mysqli_fetch_assoc($result)) {
    echo '<div class="card">';
    echo '<div class="card-body">';
    echo '<h5 class="card-title">' . $row['first_name'] . " " . $row['last_name'] . '</h5>';
    echo '<p class="card-text"> Position: ' . $row['position'] . '</p>';
    echo '<p class="card-text"> Location: ' . $row['location'] . '</p>';
    echo '<p class="card-text"> Email: ' . $row['email'] . '</p>';
    echo '<p class="card-text"> Roll no: ' . $row['roll_no'] . '</p>';
    echo '</div>';
    echo '</div>';
}

  $conn->close();
?>

</div>
</body>
</html>
