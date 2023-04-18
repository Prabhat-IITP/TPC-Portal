<?php
function redirect($url)
{
    header('Location: '.$url);
    exit();
}
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$Password = $_POST['password'];
$Email = $_POST['email'];
$PassoutYear = $_POST['PassoutYear'];
$Rollno = $_POST['rollno'];
//$hashed_password = password_hash($Password, PASSWORD_DEFAULT);
mysqli_report(MYSQLI_REPORT_OFF);
$conn = new mysqli('localhost','root','','iitp_tpc');
if($conn->connect_error)
{
 die('Connection Failed :' .$conn->connect_error);
}
else{
$stmt = $conn->prepare("insert into alumni_details (roll_no,first_name,last_name,email,passout_year,password) values(?,?,?,?,?,?)");
$stmt->bind_param("ssssis",$Rollno,$firstName,$lastName,$Email,$PassoutYear,$Password);
$stmt->execute();
redirect('login.php');
$stmt->close();
$conn->close();
}
?>