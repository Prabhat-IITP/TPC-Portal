<?php
session_start();
$id = $_SESSION['id'];
$Rollno = $_SESSION['rollno'];
function redirect($url)
{
    header('Location: '.$url);
    exit();
}
$date = $_POST['input_date'];

$start_date = new DateTime($date);
$end_date = new DateTime($_SESSION['joining_date']);
$interval = $start_date->diff($end_date);
$months = $interval->y * 12 + $interval->m + $interval->d / 30;
$monthsFinal =  round($months);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "iitp_tpc";
$conn = new mysqli($servername, $username, $password, $dbname);
// Retrieve user's first name and last name from database
$user_id = $_SESSION['user_id'];
$result = $conn->query("UPDATE alumni_company_details SET months_worked = $monthsFinal WHERE alumni_id = '$user_id'");
redirect('ALumnidashboard.php');
?>