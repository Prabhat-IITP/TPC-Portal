
<?php
function myAlert($msg, $url){
	echo '<script language="javascript">alert("'.$msg.'");</script>';
	echo "<script>document.location = '$url'</script>";
	 }
     session_start();
     $conn = mysqli_connect("localhost","root","","iitp_tpc");
	if(isset($_GET['add'])) {
      $id = $_GET['add'];
     $_SESSION['semester'] = substr($id,0,1);
     $_SESSION['branch'] = substr($id,1);
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $course = $_POST['course'];
        $credit = $_POST['credit'];
        $ccode = $_POST['ccode'];
        $semester =  $_SESSION['semester'];
        $branch = $_SESSION['branch'];
    $table = 'sem'.$semester.'_courses';
$sql = "INSERT INTO $table values ('$branch','$course','$credit','$ccode')";
$result = mysqli_query($conn, $sql);
myAlert("Course Added successfully!", "addcourse.php");
    }
?>

<!DOCTYPE html>
<html>

<head>
  <title>ADD COURSE Form</title>
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
h3{
	font-weight: bold;
	text-align: center;
	margin-bottom: 30px;
	color: #000000;
	opacity: 1;
}
</style>
</head>

<body>
  <div class="container">
  <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQg7Rl-N0vTbyqWsEemz_aBaUBkKaPpbkgkvA&usqp=CAU">
    <div class="form-container">
      <h1>Add Course:</h1>
      <form onsubmit="return submitForm(this);" , action="add.php" method="post">
    <div class="form-group">
        <label for="course">Type Course:</label>
        <input type="text" id="course" name="course" placeholder="Enter course" required>
            </div>
        <div class="form-group">
          <label for="grade">Enter Course Code:</label>
          <input type="text" id="ccode" name="ccode" placeholder="Enter Course Code" required>
        </div>
        <div class="form-group">
          <label for="grade">Enter  Course Credit:</label>
          <input type="number" id="credit" name="credit" placeholder="Enter Course credit" required>
        </div>
          <button type="submit">Submit</button>
      </form>
    </div>
      	
<script src="sweetalert.min.js"></script>
      <script>
          function submitForm(form) {
        swal({
            title: "Are you sure?",
            text: "Please Confirm the Course details once!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then(function (isOkay) {
            if (isOkay) {
              form.submit();
            }
        });
        return false;
    }
</script>

    </div>
</body>

</html> 
