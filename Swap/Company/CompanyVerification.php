<?php
session_start();
function redirect($url)
{
    header('Location: '.$url);
    exit();
}
  // Retrieve the email and password inputs from the login form
  $email = $_POST['email'];
  $password_INPUT = $_POST['password'];

  // Connect to the database
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "iitp_tpc";
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  // Query the database for the user's information
  $sql = "SELECT * FROM company_details WHERE email='$email'";
  $result = $conn->query($sql);

  if ($result->num_rows == 1) {
    // Retrieve the user's information
    $row = $result->fetch_assoc();
    $stored_password = $row['password'];

    // Compare the password entered by the user with the stored password
    if ($password_INPUT == $stored_password) {
      // Passwords match - login successful
      echo "Login successful!";
      $_SESSION['loggedin'] = true;
      $_SESSION['user_id'] = $row['id'];
      redirect('Companydashboard.php');
      $conn->close();
    exit();
    } else {
      // Passwords don't match - login failed
      echo "Invalid Password";
    }
  } else {
    // No user found with that email address - login failed
    echo "Invalid email. No user found";
  }

  // Close the database connection
  $conn->close();
?>
