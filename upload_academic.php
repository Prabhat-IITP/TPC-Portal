<?php
session_start();
if (!isset($_SESSION['sess_user'])) { /////////////////////////////////////////////////////////////////////////////change it
  header("location: login.php");
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Student Academic details Form</title>
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
  .lobel {
	font-weight: bold;
  display: inline-block;
  display: block;
	font-size: large;
	margin-bottom: 5px;
	color: #000000;
	opacity: 1;
  }
  input[type='text'],
  input[type='email'],
  input[type='number'],
  input[type='file'],
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
  button[type='upload'] {
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
  button[type='upload']:hover {
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
    <div class="form-container">
      <h1>Academic details Form</h1>
      <form onsubmit="return submitForm(this);"  action="academic.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="tenth">Tenth Percentage:</label>
          <input type="number" id="tenth" name="tenth" placeholder="Enter your Tenth class percentage" step="any" required>
        </div>
        <div class="form-group">
          <label for="twelth">Twelth percentage:</label>
          <input type="number" id="twelth" name="twelth" placeholder="Enter your Twelth class percentage" step="any" required>
        </div>
        <div class="form-group">
          <label for="cpi">CPI:</label>
          <input type="number" id="cpi" name="cpi" placeholder="Enter your current CPI" step="any" required>
        </div>
        <div class="form-group">
        <label for="back">Have you repeated any course:</label>
		    <select id="back" name="back">
			  <option value=0>NO</option>
			  <option value=1>YES</option>
		    </select>
        </div>
        <label for="Marks">Upload Semester Marks:</label>
		    <button type = "upload"><a href = "upload_marks.php">Upload</a></button>
        <div class="form-group">
        <h3 class = "lobel" for="pdfFile">Upload transcript(Format - RollNumber_transcript.pdf):</h3>
		    <input type="file" name="pdfFile" id="pdfFile" required><br>
        </div>
        <br>
        <div class="form-group">
          <button type="submit">Submit</button>
        </div>
      </form>
      </div>
      	
<script src="sweetalert.min.js"></script>
      <script>
          function submitForm(form) {
        swal({
            title: "Are you sure?",
            text: "Please make sure that all the academic details are correct.Any disperancies in future may lead to disqualification.Please Upload all the marks carefully to be eligible for some of the companies.",
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
