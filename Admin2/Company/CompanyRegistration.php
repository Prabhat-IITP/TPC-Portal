<?php
session_start();
function redirect($url)
{
  header('Location: ' . $url);
  exit();
}
?>


<!DOCTYPE html>
<html>

<head>
  <title>Company Registration Form</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
  <div class="container">
    <div class="form-container">
      <h1>Company Registration Form</h1>
      <form onsubmit="return validateForm()" action="CompanyRegister.php" method="post">
        <div class="form-group">
          <label for="CompanyName">Company Name:*</label>
          <input type="text" id="CompanyName" name="CompanyName" placeholder="Enter your Company name" required>
        </div>
        <div class="form-group">
          <label for="HRName">HR name:*</label>
          <input type="text" id="HRName" name="HRName" placeholder="Name of POC" required>
        </div>
        <div class="form-group">
          <label for="HRContact">HR contact number:*</label>
          <input type="text" id="HRContact" name="HRContact" placeholder="Contact nuber of HR" required>
        </div>
        <div class="form-group">
          <label for="email">Email Address:*</label>
          <input type="email" id="email" name="email" placeholder="Enter your email address" required>
        </div>
        <div class="form-group">
          <label for="RecruitingSince">Recruiting Since:</label>
          <input type="text" id="RecruitingSince" name="RecruitingSince" placeholder="Since when are you recruitung from IITP">
        </div>
        <div class="form-group">
          <label for="password">Password:*</label>
          <input type="password" id="password" name="password" placeholder="Enter your password" required>
        </div>
        <div class="form-group">
          <label for="confirmPassword">Confirm Password:*</label>
          <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Re-enter your password" required>
        </div>
        <div class="form-group">
          <button type="submit">Submit</button>
          <h3>Already registered? </h3>
          <a href="Companylogin.php">Click here</a>

        </div>
      </form>
    </div>
    <script>
      function validateForm() {
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
        return true;
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