<?php
session_start();
$firstname = $_SESSION['first_name'];
$lastname = $_SESSION['last_name'] ;
$email = $_SESSION['email'];
$password  = $_SESSION['password'] ;
$id  = $_SESSION['id'] ;
$rollno = $_SESSION['rollno'];


$companyname = $_SESSION['company_name'];
$hrname = $_SESSION['hr_name'];
$hrcontact = $_SESSION['hr_contact'];
$email = $_SESSION['email'];
$password = $_SESSION['password'];
$id = $_SESSION['id'];
?>

<!DOCTYPE html>
<html>

<head>
  <title>Update Details page</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<div class="container">
    <h1>Update information</h1>
    <form method="POST" action="UpdateCompanyTable.php">
      <div class="form-group">
        <label for="hr-name-input">HR Name:</label>
        <input type="text" id="hr-name-input" name="hr-name-input">
      </div>
      <div class="form-group">
        <label for="hr-contact-input">HR Contact:</label>
        <input type="text" id="hr-contact-input" name="hr-contact-input" >
      </div>
      <div class="form-group">
        <label for="email-input">Email:</label>
        <input type="text" id="email-input" name="email-input" >
      </div>
      <div class="form-group">
        <label for="Password-input">Password:</label>
        <input type="password" id="Password-input" name="Password-input" >
      </div>
      <div class="form-group">
      <button type="submit">Update</button>
      </div>
    </form>
  </div>
  <script>
 var hrname = "<?php echo $hrname ?>";
  var hrcontact = "<?php echo $hrcontact ?>";
  var email = "<?php echo $email ?>";
  var password = "<?php echo $password ?>";
  // Set the input field values to the user info
  document.getElementById("hr-name-input").value = hrname;
  document.getElementById("hr-contact-input").value = hrcontact;
  document.getElementById("email-input").value = email;
  document.getElementById("Password-input").value = password;
</script>


</body>

</html>