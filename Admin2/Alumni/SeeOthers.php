<!DOCTYPE html>
<html>

<head>
  <title>See others from IITP</title>
  <link rel="stylesheet" type="text/css" href="style5.css">
</head>

<body>
<div class="card-deck">
    <?php
    session_start();
    $id = $_SESSION['id'];
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "iitp_tpc";
    
    $conn = mysqli_connect($host, $user, $password, $database);
        $query = "SELECT * FROM alumni_company_details where alumni_id = $id AND months_worked = 'Ongoing'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $company = $row['company_name'];
        $query1 = "SELECT * FROM alumni_company_details WHERE company_name = '$company' AND alumni_id != $id";
        $result1 = mysqli_query($conn, $query1);
        // Loop through the data and display it in cards
        while ($row1 = mysqli_fetch_assoc($result1)) {
            echo '<div class="card">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $row1['company_name'] . '</h5>';
            echo '<p class="card-text"> Position: ' . $row1['position'] . '</p>';
            echo '<p class="card-text"> Location: ' . $row1['location'] . '</p>';
            echo '<p class="card-text">Joining Date: ' . $row1['joining_date'] . '</p>';
            echo '<p class="card-text">Months worked: ' . $row1['months_worked'] . '</p>';
            echo '</div>';
            echo '</div>';
        }
        
        // Close the database connection
        mysqli_close($conn);
    ?>
</div>
</body>

</html>
