<?php
session_start();
$CompanyName = $_SESSION['company_name'];
$ProfileName =  $_POST['ProfileName'];
$c_id  = $_SESSION['id'];
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
$sql = "Select * from company_jobs where c_id = $c_id AND profile_name = ? LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $ProfileName);
$stmt->execute();
$result = $stmt->get_result();
$row = mysqli_fetch_assoc($result);
$mincpi = $row['min_cpi'];
$back = $row['back_allowed'];
$gender = $row['gender_specific'];
$batch = $row['Batch'];
$branch = $row['branch_specialization'];
$conn->close();
?>


<!DOCTYPE html>
<html>

<head>
    <title>Eligible Candidates</title>
    <link rel="stylesheet" type="text/css" href="styleTable.css">
</head>

<body>
    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Roll Number</th>
                    <th>Specialization</th>
                    <th>CPI</th>
                    <th>Tenth Marks</th>
                    <th>Twelfth Marks</th>
                    <th>Back</th>
                    <th>Gender</th>
                    <th>Age</th>
                </tr>
            </thead>
            <tbody>
                <?php
                function redirect($url)
                {
                    header('Location: ' . $url);
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
                $sql = "SELECT *
        FROM student_details as b
        WHERE  ((? = 'Open') OR (? LIKE CONCAT('%', b.Specialization, '%')))
        AND ((? = 'ForAll' AND (b.Gender = 'Male' OR b.Gender = 'Female')) OR (? = 'Only for girls' AND b.Gender = 'Female')) 
        AND b.CPI > ? 
        AND b.Passing_Year = ? 
        AND (? = 'YES' OR b.back = 'No')";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssssdis", $branch, $branch, $gender, $gender, $mincpi, $batch, $back);
                $stmt->execute();
                $result = $stmt->get_result();
                // Loop through the data and display it in cards
                //while ($row = $result->fetch_assoc()) {
                //echo '<div class="card">';
                //echo '<div class="card-body">';
                //echo '<h5 class="card-title"> Name: ' . $row['Name'] . '</h5>';
                // echo '<p class="card-text"> Roll: ' . $row['Roll_Number'] . '</p>';
                //echo '<p class="card-text"> Age: ' . $row['Age'] . '</p>';
                //  echo '<p class="card-text"> Branch: ' . $row['Specialization'] . '</p>';
                //echo '<p class="card-text"> Gender: ' . $row['Gender'] . '</p>';
                //  echo '</div>';
                //    echo '</div>';
                //}
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['Name'] . '</td>';
                    echo '<td>' . $row['Roll_Number'] . '</td>';
                    echo '<td>' . $row['Specialization'] . '</td>';
                    echo '<td>' . $row['CPI'] . '</td>';
                    echo '<td>' . $row['tenth'] . '</td>';
                    echo '<td>' . $row['twelth'] . '</td>';
                    echo '<td>' . $row['Back'] . '</td>';
                    echo '<td>' . $row['Gender'] . '</td>';
                    echo '<td>' . $row['Age'] . '</td>';
                    echo '</tr>';
                }
                $conn->close();
                ?>
            </tbody>
        </table>

    </div>
</body>

</html>