<?php
    session_start();
function myAlert($msg, $url){
	echo '<script language="javascript">alert("'.$msg.'");</script>';
	echo "<script>document.location = '$url'</script>";
	 }
   // check if form is submitted  
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$Name = test_input($_POST['Nameinput']);
$Rollno = test_input($_POST['Rollnoinput']);
$Age = test_input($_POST['Ageinput']);
$Specialization = test_input($_POST['branch']);
$Interest = test_input($_POST['Interestinput']);
$Passing_Year = test_input($_POST['PassoutYearinput']);
$email = test_input($_POST['emailinput']);
$Password = test_input($_POST['password']);
$confirm_password = test_input($_POST['confirmPassword']);
$sessionRoll = $_SESSION["sess_user"];
	$conn = mysqli_connect("localhost","root","","iitp_tpc");
	// validate first name
	    $error = 0;
		// check if first name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z ]*$/",$Name)) {
			$error = 1;
			myAlert("Only letters and white space allowed in name", "update.php");
		}
        //email already registered
		$sql = "select * from student_login where Email = '$email'";
		$rslt = mysqli_query($conn,$sql);
        $row =  mysqli_fetch_array($rslt);
        $sessionEmail = $row["Email"];
		if (mysqli_num_rows($rslt) > 0 && $email != $sessionEmail) {
			$error = 1;
			myAlert("Email already registered. Choose any other email.", "update.php");
		}
        $sql = "select * from student_login where Roll_Number = '$Rollno'";
		$rslt = mysqli_query($conn,$sql);
		if (mysqli_num_rows($rslt) > 0 && $Rollno != $sessionRoll) {
			$error = 1;
			myAlert("Student already registered. Can not update", "update.php");
		}
        if (mb_strlen($_POST["password"]) <= 8) {
            $error = 1;
            myAlert("Your Password Must Contain At Least 8 Characters!", "update.php");
        }
        elseif(!preg_match("#[0-9]+#",$Password)) {
            $error = 1;
            myAlert("Your Password Must Contain At Least 1 Number!", "update.php");
        }
        elseif(!preg_match("#[A-Z]+#",$Password)) {
            $error = 1;
            myAlert("Your Password Must Contain At Least 1 Capital Letter!'", "update.php");
        }
        elseif(!preg_match("#[a-z]+#",$Password)) {
            $error = 1;
            myAlert("Your Password Must Contain At Least 1 Lowercase Letter!'", "update.php");
        }
        elseif(!preg_match("#[\W]+#",$Password)) {
            $error = 1;
            myAlert("Your Password Must Contain At Least 1 Special Character!", "update.php");
        } 
        if ($Password != $confirm_password) {
            $error = 1;
            myAlert("Passwords must match!", "update.php");
        }
		if($error == 0){
			    $query1 = "update student_login set Roll_Number = '$Rollno',Email='$email',password='$Password' where Roll_Number='$sessionRoll'";
				$query = "update student_details set Name='$Name',Age='$Age',Specialization='$Specialization',Interest='$Interest',Passing_Year='$Passing_Year' where Roll_Number='$sessionRoll'";
                $result1 = mysqli_query($conn,$query1);
				$result = mysqli_query($conn,$query);
				if ($result && $result1) {
					
					myAlert("Account Successfully Updated!", "dashboard.php");
				} else {
					echo "<script>alert('Something went wrong!')</script>";
				}
		}
}

// function to sanitize user input
function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>