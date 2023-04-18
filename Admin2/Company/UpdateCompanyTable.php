<?php
function redirect($url)
{
  header('Location: ' . $url);
  exit();
}
session_start();
$hrnameNEW = $_POST['hr-name-input'];
$hrcontactNEW = $_POST['hr-contact-input'];
$emailNEW = $_POST['email-input'];
$PasswordNEW = $_POST['Password-input'];
$id = $_SESSION['user_id'];

$host = "localhost";
$user = "root";
$password = "";
$database = "iitp_tpc";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "UPDATE company_details SET hr_name='$hrnameNEW', hr_contact='$hrcontactNEW', email='$emailNEW' , password='$PasswordNEW' WHERE id=$id";
if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully";
    mysqli_close($conn);
    redirect("CompanyLogin.php");
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

mysqli_close($conn);
?>