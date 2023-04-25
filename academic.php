<?php
session_start();
if (!isset($_SESSION['sess_user'])) { 
  header("location: login.php");
}
  function myAlert($msg, $url){
  echo '<script language="javascript">alert("'.$msg.'");</script>';
  echo "<script>document.location = '$url'</script>";
  }
  $conn = mysqli_connect("localhost","root","","iitp_tpc");
  $Rollno = $_SESSION['sess_user']; 
  $tenth = $_POST['tenth'];
  $twelth = $_POST['twelth'];
  $cpi = $_POST['cpi'];
  $back = $_POST['back'];
if($_FILES['pdfFile']['error'] == 0) {
	$fileName = $_FILES['pdfFile']['name'];
	$fileTmpName = $_FILES['pdfFile']['tmp_name'];
	$fileSize = $_FILES['pdfFile']['size'];
	$fileType = $_FILES['pdfFile']['type'];
	// Check if file is a PDF
	if($fileType != 'application/pdf') {
    myAlert('Only PDF files are allowed to be uploaded.','upload_academic.php');
	}
	
	// Upload file to server
	$uploadPath = 'http://localhost/mini_project/uploads/' . $fileName;
	if(move_uploaded_file($fileTmpName, $uploadPath)) {
		$query = "update student_details set tenth = '$tenth',twelth = '$twelth',back = '$back',transcript='$uploadPath',CPI='$cpi' where Roll_Number = '$Rollno'";
            $result = mysqli_query($conn,$query);
            if ($result) {
                session_start();
                myAlert("Academic details added Succesfully!", "dashboard.php");
            } else {
                echo "<script>alert('Something went wrong!')</script>";
            }
	} else {
     myAlert('Error uploading file.','upload_academic.php');
	}
} 
else {
	myAlert('Form Could not be Submitted!','upload_academic.php');
}
?>