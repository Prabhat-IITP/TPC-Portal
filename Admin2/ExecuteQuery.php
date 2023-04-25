<?php
function redirect($url)
{
    header('Location: '.$url);
    exit();
}
$Query = $_POST['query'];
mysqli_report(MYSQLI_REPORT_OFF);
$conn = new mysqli('localhost','root','','iitp_tpc');
if($conn->connect_error)
{
 die('Connection Failed :' .$conn->connect_error);
}
else{
$stmt = $conn->prepare("?");
$stmt->bind_param("s",$Query);
if(!$stmt->execute()) echo "Incorrect query";
redirect('Dashboard.php');
$stmt->close();
$conn->close();
}
?>