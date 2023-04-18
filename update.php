<?php
session_start();
if (!isset($_SESSION['sess_user'])) {
  header("location: login.php");
}
$conn = mysqli_connect("localhost","root","","iitp_tpc");
$Rollno = $_SESSION['sess_user'];
$query = "select * from student_details where Roll_Number = '$Rollno'";
$result = mysqli_query($conn,$query);
$row =  mysqli_fetch_array($result);
$Name = $row["Name"];
$Rollno = $row["Roll_Number"];
$Age = $row["Age"];
$Specialization = $row["Specialization"];
$Interest = $row["Interest"];
$Passing_Year = $row["Passing_Year"];
$query1= "select * from student_login where Roll_Number = '$Rollno'";
$result1 = mysqli_query($conn,$query1);
$row1 =  mysqli_fetch_array($result1);
$email = $row1["Email"];
?>
<!DOCTYPE html>
<html>

<head>
  <title>Student Registration Form</title>
  <style>
    img {
  position: absolute;
	top: 0;
	left: 50%;
	transform: translateX(-50%);
}
   
    body {
	font-family: 'Roboto', sans-serif;
	font-weight: bold;
	color: black;
	background-color: #f5f5f5;
	background-repeat: no-repeat;
	background-size: auto;
	/* background-image: url(https://cache.careers360.mobi/media/article_images/2023/2/18/iit-patna-featured-image.jpg); */
  }
form-container {
    margin: 0 auto;
    max-width: 300px;
	max-height: 600px;
    padding: 50px 50px 30px 20px;
    background-color: rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(80px);
    border-radius: 10px;
	color: #6ee5f2;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
} 
  .container {
  position: relative;
	margin: 50px auto;
	max-width: 500px;
	/* margin-left: 50%; */
	background-color:rgba(255, 255, 255, 0.5);;
	background-color:#fcfcfc;
	border-radius: 10px;
	box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
	padding: 50px 50px 30px 20px;
  padding-top: 220px; 
  } 
  h1 {
	font-weight: bold;
	text-align: center;
	margin-bottom: 30px;
	color: #000000;
	opacity: 1;
  }

  label {
	font-weight: bold;
	font-size: large;
	display: block;
	margin-bottom: 5px;
	color: #000000;
	opacity: 1;
  }

  input[type='text'],
  input[type='email'],
  input[type='number'],
  input[type='password'] {
	width: 100%;
	padding: 10px;
	margin-bottom: 20px;
	border-radius: 5px;
	border: 1px solid #cccccc;
	opacity: 1;
  }

  button[type='submit'] {
	display: block;
	margin: 0 auto;
	padding: 10px 20px;
	background-color:#37daf0;
	border: none;
	color: #ffffff;
	border-radius: 5px;
	cursor: pointer;
	transition: background-color 0.3s ease;
	opacity: 1;
  }

  button[type='submit']:hover {
	background-color: #10d7ed;
  } 
  
  label {
	display: block;
	margin-bottom: 10px;
}

select {
  width: 100%;
	padding: 10px;
	margin-bottom: 20px;
	border-radius: 5px;
	border: 1px solid #cccccc;
	opacity: 1;
	font-size: 16px;
	border-radius: 5px;
}
h2{
    text-align: center;
}
</style>
</head>

<body>
  <div class="container">
  <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQg7Rl-N0vTbyqWsEemz_aBaUBkKaPpbkgkvA&usqp=CAU">
    <div class="form-container">
      <h1>Details Updation Form</h1>
      <h2>Change the fields you want to update.</h2>
      <form onsubmit="return submitForm()" , action="update_table.php" method="post">
        <div class="form-group">
          <label for="Name-input">Name:</label>
          <input type="text" id="Name-input" name="Nameinput">
        </div>
        <div class="form-group">
          <label for="Rollno-input">Roll Number:</label>
          <input type="text" id="Rollno-input" name="Rollnoinput" >
        </div>
        <div class="form-group">
          <label for="Age-input">Age:</label>
          <input type="number" id="Age-input" name="Ageinput" >
        </div>
        <div class="form-group">
          <label for="email-input">Email Address:</label>
          <input type="email" id="email-input" name="emailinput">
        </div>
        <div class="form-group">
        <label for="branch">Select Specialization:</label>
		    <select id="branch" name="branch">
			  <option value="CSE">Computer Science and Engineering</option>
			  <option value="AIDS">Artificial Intelligence and Data Science</option>
			  <option value="Mnc">Mathematics and Computing</option>
        <option value="EE">Electrical Engineering</option>
        <option value="ME">Mechanical Engineering</option>
        <option value="CB">Chemical Engineering</option>
        <option value="EP">Engineering Physics</option>
        <option value="CE">Civil Engineering</option>
        <option value="MME">Metallurgical and Materials Engineering</option>
		    </select>
        </div>
        <div class="form-group">
          <label for="PassoutYear-input">Passing Year:</label>
          <input type="number" id="PassoutYear-input" name="PassoutYearinput" >
        </div>
        <div class="form-group">
          <label for="Interest-input">Interest:</label>
          <input type="text" id="Interest-input" name="Interestinput">
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" placeholder="Enter new password" required>
        </div>
        <div class="form-group">
          <label for="confirmPassword">Confirm Password:</label>
          <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Re-enter your new password" required>
        </div>
        <div class="form-group">
          <button type="submit">Submit</button>
        </div>
      </form>
      </div>
      <script>
        // Get the user info from the left side
            var Name = "<?php echo $Name ?>";
            var Rollno = "<?php echo $Rollno ?>";
            var Age = "<?php echo $Age ?>";
            var email = "<?php echo $email ?>";
            var Specialization = "<?php echo $Specialization ?>";
            var Interest = "<?php echo $Interest ?>";
            var PassoutYear = "<?php echo $Passing_Year ?>";
            // Set the input field values to the user info
            document.getElementById("Name-input").value = Name;
            document.getElementById("Rollno-input").value = Rollno;
            document.getElementById("Age-input").value = Age;
            document.getElementById("email-input").value = email;
            document.getElementById("PassoutYear-input").value = PassoutYear;
            document.getElementById("Interest-input").value = Interest;
</script>

</div>
</body>

</html> 