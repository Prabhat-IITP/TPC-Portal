<!DOCTYPE html>
<html>

<head>
    <title>Enter Selected Candidates </title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h1>Enter Selected Candidates </h1>
            <form method="POST">
                <div class="form-group">
                    <label for="RollNo">Roll Number:</label>
                    <input type="text" id="RollNo" name="RollNo" placeholder="Enter Roll number of selected candidate" required>
                </div>
                <div class="form-group">
                    <label for="ProfileName">Profile Name:</label>
                    <select name="ProfileName" id="ProfileName">
                        <option value="SDE">SDE</option>
                        <option value="Finance">Finance</option>
                        <option value="Management">Management</option>
                        <option value="Core">Core</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="CTC">CTC:</label>
                    <input type="text" id="CTC" name="CTC" placeholder="Enter CTC" required>
                </div>
                <div class="form-group">
                    <button type="submit">Submit</button>

                </div>
        </div>
    </div>
    </form>
</body>

</html>
<?php
function redirect($url)
{
    header('Location: '.$url);
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $RollNo = htmlspecialchars($_REQUEST['RollNo']);
    $ProfileName = htmlspecialchars($_REQUEST['ProfileName']);
    $CTC = htmlspecialchars($_REQUEST['CTC']);
    session_start();
mysqli_report(MYSQLI_REPORT_OFF);
$conn = new mysqli('localhost','root','','iitp_tpc');
if($conn->connect_error)
{
 die('Connection Failed :' .$conn->connect_error);
}
else{
    $stmt = $conn->prepare("Select Name from student_details where Roll_Number = ?");
    $stmt->bind_param("s",$RollNo);
    if (!$stmt->execute()) {
        die("Error: " . $stmt->error);
    }
$result = $stmt->get_result();
$row = mysqli_fetch_assoc($result);
$StudentName = $row['Name'];
$CompanyName = $_SESSION['company_name'];




$stmt = $conn->prepare("insert into job_offered (roll_no,name,company_name,CTC,Profile) values(?,?,?,?,?)");
$stmt->bind_param("sssds",$RollNo,$StudentName,$CompanyName,$CTC,$ProfileName);
if (!$stmt->execute()) {
    die("Error: " . $stmt->error);
}
redirect('EnterSelected.php');
$stmt->close();
$conn->close();
}


}
?>