<?php
session_start();
$firstnameNEW = $_POST['first-name-input'];
$lastnameNEW = $_POST['last-name-input'];
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
$sql = "UPDATE alumni_details SET first_name='$firstnameNEW', last_name='$lastnameNEW', email='$emailNEW' , password='$PasswordNEW' WHERE id=$id";
if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

mysqli_close($conn);
?>