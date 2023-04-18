<?php

function help($name, $sem)
{
    echo "Sem1 Courses";
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "iitp_tpc";
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "Select * from sem1_courses where Specialization = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td> 1 </td>';
        echo '<td>' . $row['Course'] . '</td>';
        echo '<td>' . $row['Credit'] . '</td>';
        echo '<td>' . $row['CCode'] . '</td>';
        echo '</tr>';
    }
    $sql = "Select * from sem2_courses where Specialization = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td> 2 </td>';
        echo '<td>' . $row['Course'] . '</td>';
        echo '<td>' . $row['Credit'] . '</td>';
        echo '<td>' . $row['CCode'] . '</td>';
        echo '</tr>';
    }
    $sql = "Select * from sem3_courses where Specialization = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td> 3 </td>';
        echo '<td>' . $row['Course'] . '</td>';
        echo '<td>' . $row['Credit'] . '</td>';
        echo '<td>' . $row['CCode'] . '</td>';
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
        <h1>Enter Branch to know courses</h1>
        <form method="post">
            <div class="form-group">
                <label for="Branch">Enter Branch:*</label>
                <select name="Branch" id="Branch" required>
                    <option value="CSE">Computer Science and Engineering</option>
                    <option value="EEE">Electrical and Electronics Engineering </option>
                    <option value="MNC">Maths and Computing</option>
                    <option value="AI/DS">Artificial Intelligence and Data Science</option>
                    <option value="PH">Engineering Physics</option>
                    <option value="MME">Material and Metallurgical Engineering</option>
                    <option value="ME">Mechnical Engineering</option>
                    <option value="CE">Civil Engineering</option>
                    <option value="CH">Chemical Engineering</option>
                </select>
                <div class="form-group">
                    <button type="submit">Submit</button>
                </div>
                <a href="SeeMarks.php">See marks</a>
            </div>
        </form>
    </div>
    <div class="container1">
        <table>
            <thead>
                <tr>
                    <th>Semester</th>
                    <th>Course</th>
                    <th>Credit</th>
                    <th>CCode</th>
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
                    $name = htmlspecialchars($_REQUEST['Branch']);
                    $sem = 'sem1_courses';
                    help($name, $sem);
                }
                ?>
            </tbody>
        </table>

    </div>

</body>

</html>