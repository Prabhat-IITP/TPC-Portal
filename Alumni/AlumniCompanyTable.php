<?php
session_start();
$id = $_SESSION['id'];
$Rollno = $_SESSION['rollno'];
function redirect($url)
{
    header('Location: '.$url);
    exit();
}
$CompanyName = $_POST['CompanyName'];
$Position = $_POST['Position'];
$Location = $_POST['Location'];
$JoiningDate = $_POST['JoiningDate'];
$MonthsWorked = $_POST['MonthsWorked']; //int
$CTC = $_POST['CTC'];
//$hashed_password = password_hash($Password, PASSWORD_DEFAULT);
mysqli_report(MYSQLI_REPORT_OFF);
$conn = new mysqli('localhost','root','','iitp_tpc');
if($conn->connect_error)
{
 die('Connection Failed :' .$conn->connect_error);
}
else{
$stmt = $conn->prepare("insert into alumni_company_details (alumni_id,company_name,position,location,joining_date,months_worked,CTC) values(?,?,?,?,?,?,?)");
$stmt->bind_param("issssss",$id,$CompanyName,$Position,$Location,$JoiningDate,$MonthsWorked,$CTC);
$stmt->execute();
redirect('Alumnidashboard.php');
$stmt->close();
$conn->close();
}
?>