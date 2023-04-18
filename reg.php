<?php
// check if form is submitted
function myAlert($msg, $url){
	echo '<script language="javascript">alert("'.$msg.'");</script>';
	echo "<script>document.location = '$url'</script>";
	 }
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$conn = mysqli_connect("localhost","root","","iitp_tpc");
	// validate first name
	    $error = 0;
		$first_name = test_input($_POST["Name"]);
		// check if first name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z ]*$/",$first_name)) {
			$error = 1;
			myAlert("Only letters and white space allowed in name", "index.php");
		}
        $email = test_input($_POST["email"]);
        //email already registered
		$sql = "select * from student_login where Email = '$email'";
		$rslt = mysqli_query($conn,$sql);
		if (mysqli_num_rows($rslt) > 0) {
			$error = 1;
			myAlert("Email already registered. Please login.", "index.php");
		}
        $Rollno = test_input($_POST["Rollno"]);
        $sql = "select * from student_login where Roll_Number = '$Rollno'";
		$rslt = mysqli_query($conn,$sql);
		if (mysqli_num_rows($rslt) > 0) {
			$error = 1;
			myAlert("Student already registered. Please login.", "index.php");
		}
		    $Name = $_POST["Name"];
			$password = $_POST["password"];
			$confirm_password = $_POST["confirmPassword"];
            $age = $_POST["Age"];
            $branch = $_POST['branch'];
            $passout = $_POST['PassoutYear'];
            $Interest = $_POST['Interest'];
			$gender = $_POST['gender'];
		if($error == 0){
			    $query1 = "insert into student_login values('$Rollno','$email','$password')";
				$query2 = "insert into student_placed(Roll_Number,Year,Specialization) values('$Rollno','$passout','$branch')";
				$query = "insert into Student_details(Name,Roll_Number,Age,Specialization,Interest,Passing_Year,Gender) values('$Name','$Rollno','$age','$branch','$Interest','$passout','$gender')";
                $result1 = mysqli_query($conn,$query1);
				$result2 = mysqli_query($conn,$query2);
				$result = mysqli_query($conn,$query);
				if ($result && $result1) {
					
					myAlert("Account Successfully Registered!", "dashboard.php");
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