<!DOCTYPE html>
<html>

<head>
  <title>Update Details page</title>
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
        $query = "SELECT * FROM alumni_company_details where alumni_id = $id  ORDER BY joining_date DESC";
        $result = mysqli_query($conn, $query);
        
        // Loop through the data and display it in cards
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="card">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $row['company_name'] . '</h5>';
            echo '<p class="card-text"> Position: ' . $row['position'] . '</p>';
            echo '<p class="card-text"> Location: ' . $row['location'] . '</p>';
            echo '<p class="card-text">Joining Date: ' . $row['joining_date'] . '</p>';
            echo '<p class="card-text">Months worked: ' . $row['months_worked'] . '</p>';
            echo '<p class="card-text">CTC: ' . $row['CTC'] . '</p>';
            echo '</div>';
            echo '</div>';
        }
        
        // Close the database connection
        mysqli_close($conn);
    ?>
</div>
</body>

</html>
