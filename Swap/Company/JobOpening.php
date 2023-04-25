<?php
session_start();
$id = $_SESSION['id'];
function redirect($url)
{
    header('Location: '.$url);
    exit();
}
$ProfileName = $_POST['ProfileName'];
$JobDescription = $_POST['JobDescription'];
$JobLocation = $_POST['JobLocation'];
$MinCPI = $_POST['MinCPI'];
$BackAllowed = $_POST['BackAllowed'];
$GenderSpecific = $_POST['GenderSpecific']; //int
$CTC = $_POST['CTC'];
$Batch = $_POST['Batch'];
if (isset($_POST['BranchSpecialization']) && !empty($_POST['BranchSpecialization']))
{
    $BranchSpecialization = $_POST['BranchSpecialization'];
    $comma_separated_values = implode(",", $BranchSpecialization);
}
else $comma_separated_values = 'NULL';
mysqli_report(MYSQLI_REPORT_OFF);
$conn = new mysqli('localhost','root','','iitp_tpc');
if($conn->connect_error)
{
 die('Connection Failed :' .$conn->connect_error);
}
else{
$stmt = $conn->prepare("insert into company_jobs (c_id,profile_name,job_description,job_location,min_cpi,back_allowed,gender_specific,Batch,CTC,branch_specialization) values(?,?,?,?,?,?,?,?,?,?)");
$stmt->bind_param("isssdsssds",$id,$ProfileName,$JobDescription,$JobLocation,$MinCPI,$BackAllowed,$GenderSpecific,$Batch,$CTC,$comma_separated_values);
if (!$stmt->execute()) {
    die("Error: " . $stmt->error);
}
redirect('Companydashboard.php');
$stmt->close();
$conn->close();
}
?>