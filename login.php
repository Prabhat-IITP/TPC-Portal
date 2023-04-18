<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = mysqli_connect("localhost","root","","iitp_tpc");
	$email = $_POST['email'];
	$pwd = $_POST['password'];
	
	// select query to check if profile exists 
	$query = "SELECT * FROM student_login WHERE Email='$email' and password='$pwd'";
	$result = mysqli_query($conn, $query);
	
	//If there exists a row with the given credentials, then redirect to respective profile page otherwise stay on same page by alert 
	if (mysqli_num_rows($result) != 0) {
        $query = "SELECT Roll_Number FROM student_login WHERE email='$email' and password='$pwd'";
	    $result = mysqli_query($conn, $query);
			$row =  mysqli_fetch_array($result);
            $Rollno = $row["Roll_Number"];
            session_start();
		$_SESSION['sess_user'] = $Rollno;
		 header("Location: dashboard.php");
	} else {
		echo "<script>alert('Invalid email or password.')</script>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Student Login</title>
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
</style>
</head>
<body>
	<div class="container">
	<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQg7Rl-N0vTbyqWsEemz_aBaUBkKaPpbkgkvA&usqp=CAU">
		<h1>Student Login</h1>
		<div class="form-container">
		<form action="login.php" method="POST" enctype="multipart/form-data">
		<div class="form-group">
			<label for="email">Email:</label>
			<input type="email" id="email" name="email" required>
        </div>
		<div class="form-group">
			<label for="password">Password:</label>
			<input type="password" id="password" name="password" required>
       </div>
       <div class="form-group">
	   <button type="submit">Submit</button>
        </div>
		</form>
	</div>
	<p>don't have an account <a href="index.php">register</a></p>
</div>
</body>
</html>