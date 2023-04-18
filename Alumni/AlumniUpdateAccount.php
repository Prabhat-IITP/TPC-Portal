<?php
session_start();
$firstname = $_SESSION['first_name'];
$lastname = $_SESSION['last_name'] ;
$email = $_SESSION['email'];
$password  = $_SESSION['password'] ;
$id  = $_SESSION['id'] ;
$rollno = $_SESSION['rollno'];
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
    <form method="POST" action="UpdateAlumniTable.php">
      <div class="form-group">
        <label for="first-name-input">First Name:</label>
        <input type="text" id="first-name-input" name="first-name-input">
      </div>
      <div class="form-group">
        <label for="last-name-input">Last Name:</label>
        <input type="text" id="last-name-input" name="last-name-input" >
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
      var firstname = "<?php echo $firstname ?>";
  var lastname = "<?php echo $lastname ?>";
  var email = "<?php echo $email ?>";
  var password = "<?php echo $password ?>";
  // Set the input field values to the user info
  document.getElementById("first-name-input").value = firstname;
  document.getElementById("last-name-input").value = lastname;
  document.getElementById("email-input").value = email;
  document.getElementById("Password-input").value = password;
</script>


</body>

</html>