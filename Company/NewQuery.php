<?php

function help($name,$Orderby)
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "iitp_tpc";
    $conn = new mysqli($servername, $username, $password, $dbname);
   
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $c_id  = $_SESSION['id'];
    $sql = "Select * from company_jobs where c_id = $c_id AND profile_name = ? LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $name);
$stmt->execute();
$result = $stmt->get_result();
$row = mysqli_fetch_assoc($result);
$mincpi = $row['min_cpi'];
$back = $row['back_allowed'];
$gender = $row['gender_specific'];
$batch = $row['Batch'];
$branch = $row['branch_specialization'];
    $sql = "SELECT *
FROM student_details as b
WHERE  ((? = 'Open') OR (? LIKE CONCAT('%', b.Specialization, '%')))
AND ((? = 'ForAll' AND (b.Gender = 'Male' OR b.Gender = 'Female')) OR (? = 'Only for girls' AND b.Gender = 'Female')) 
AND b.CPI > ? 
AND b.Passing_Year = ? 
AND (? = 'YES' OR b.back = 'No')
ORDER BY ? ASC ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssdiss", $branch, $branch, $gender, $gender, $mincpi, $batch, $back,$Orderby);
    $stmt->execute();
    $result = $stmt->get_result();
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
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="style6.css">
</head>

<body>
    <div class="container">
        <h1>Sort Eligible Candidates</h1>
        <form method="post">
            <div class="form-group">
                <label for="ProfileName">Profile Name:</label>
                <select name="ProfileName" id="ProfileName">
                    <option value="Finance">Finance</option>
                    <option value="SDE">SDE</option>
                    <option value="Management">Management</option>
                    <option value="Core">Core</option>
                    <option value="Others">Others</option>
                </select>
                <label for="OrderBy">Order by :</label>
                <select name="OrderBy" id="OrderBy">
                    <option value="CPI">CPI</option>
                    <option value="Tenth">Tenth Marks</option>
                    <option value="Twelth">Twelfth Marks</option>
                    <option value="Gender">Gender</option>
                    <option value="Back">Back</option>
                </select>
                <div class="form-group">
                    <button type="submit">Submit</button>
                </div>
            </div>
        </form>
    </div>
    <div class="container1">
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
                session_start();
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
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // collect value of input field
                    $name = htmlspecialchars($_REQUEST['ProfileName']);
                    $OrderBy= htmlspecialchars($_REQUEST['OrderBy']);
                    help($name,$OrderBy);
                }
                ?>
            </tbody>
        </table>

    </div>

</body>

</html>