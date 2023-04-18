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
</style>
</head>

<body>
  <div class="container">
  <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQg7Rl-N0vTbyqWsEemz_aBaUBkKaPpbkgkvA&usqp=CAU">
    <div class="form-container">
      <h1>Student Registration Form</h1>
      <form onsubmit="return submitForm(this);" , action="reg.php" method="post">
        <div class="form-group">
          <label for="Name">Name:</label>
          <input type="text" id="Name" name="Name" placeholder="Enter your name" required>
        </div>
        <div class="form-group">
          <label for="Rollno">Roll Number:</label>
          <input type="text" id="Rollno" name="Rollno" placeholder="Enter your Roll Number" required>
        </div>
        <div class="form-group">
          <label for="Age">Age:</label>
          <input type="number" id="Age" name="Age" placeholder="Enter your Age" required>
        </div>
        <div class="form-group">
          <label for="email">Email Address:</label>
          <input type="email" id="email" name="email" placeholder="Enter your email address" required>
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
        <label for="gender">Select Gender:</label>
		    <select id="gender" name="gender">
			  <option value="M">Male</option>
			  <option value="F">Female</option>
		    </select>
        </div>
        <div class="form-group">
          <label for="PassoutYear">Passing Year:</label>
          <input type="number" id="PassoutYear" name="PassoutYear" placeholder="Enter your Passing Year" required>
        </div>
        <div class="form-group">
          <label for="Interest">Interest:</label>
          <input type="text" id="Interest" name="Interest" placeholder="Enter your Interests" required>
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" placeholder="Enter your password" required>
        </div>
        <div class="form-group">
          <label for="confirmPassword">Confirm Password:</label>
          <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Re-enter your password" required>
        </div>
        <div class="form-group">
          <button type="submit">Submit</button>
        </div>
      </form>
      </div>
      	
<script src="sweetalert.min.js"></script>
      <script>
          function submitForm(form) {
          const email = document.getElementById("email").value;
          const password = document.getElementById("password").value;
          const confirmPassword = document.getElementById("confirmPassword").value;
          if (!validateEmail(email)) {
            alert("Please enter a valid email address.");
            return false;
          }
          if (!checkPasswordStrength(password)) {
            alert("Please enter a stronger password.");
            return false;
          }
          if (password !== confirmPassword) {
            alert("Passwords do not match.");
            return false;
          }
        swal({
            title: "Are you sure?",
            text: "Please Confirm all the details provided by you are correct",
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
    
    function validateEmail(email) {
          const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
          return regex.test(email);
        }

        function checkPasswordStrength(password) {
          const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+~`|}{\[\]\\\:;\"\'<>,.\/?-])[A-Za-z\d!@#$%^&*()_+~`|}{\[\]\\\:;\"\'<>,.\/?-]{8,}$/;
          return regex.test(password);
        }
</script>

    </div>
</body>

</html> 
