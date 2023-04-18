<?php
session_start();
$id = $_SESSION['id'];
$host = "localhost";
$user = "root";
$password = "";
$database = "iitp_tpc";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "DELETE from company_details where id = $id";
if (mysqli_query($conn, $sql)) {
    echo "Record DELETED successfully";
} else {
    echo "Error DELETING record: " . mysqli_error($conn);
}
mysqli_close($conn);
?>

