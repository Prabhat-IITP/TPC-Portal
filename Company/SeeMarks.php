
<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="style6.css">
</head>

<body>
    <div class="container">
        <h1>See Student Grades</h1>
        <form method="post">
            <div class="form-group">
                <label for="RollNo">Roll No:*</label>
                <input type="text" id="RollNo" name="RollNo" placeholder="Enter student's Roll Number" required>
            </div>
            <div class="form-group">
                <label for="CourseName">Course Name:*</label>
                <input type="text" id="CourseName" name="CourseName" placeholder="Enter course name" required>
            </div>
            <div class="form-group">
                <button type="submit">Submit</button>
            </div>
    </div>
    </form>
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
                    $RollNo = htmlspecialchars($_REQUEST['RollNo']);
                    $Course = htmlspecialchars($_REQUEST['CourseName']);
                    $sql = "Select * from sem1_marks where Course = ? AND Roll = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ss", $Course,$RollNo);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();
                    $num = $row['Marks'];
                    echo '<p style="text-align:center; font-weight:bold; position:absolute; top:15%; right: 49%;font-size:24px;color:#FE7062;;"> Grade: ' . $num . '</p>';

                }
                ?>

</body>

</html>