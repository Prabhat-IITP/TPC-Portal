<?php
session_start();
$firstnameNEW = $_POST['firstnameinput'];
$lastnameNEW = $_POST['lastnameinput'];
$emailNEW = $_POST['emailinput'];
$PasswordNEW = $_POST['Passwordinput'];
$id = $_SESSION['user_id'];

$host = "localhost";
$user = "root";
$password = "";
$database = "users";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "UPDATE users SET first_name='$firstnameNEW', last_name='$lastnameNEW', email='$emailNEW' , password='$PasswordNEW' WHERE id=$id";
if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

mysqli_close($conn);
?>