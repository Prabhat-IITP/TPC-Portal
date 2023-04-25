<?php
// Start session to access logged in user's information
session_start();

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  // Redirect user to login page
  echo "NOT LOGGED IN";
  header("Location: login.php");
  exit();
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "iitp_tpc";
$conn = new mysqli($servername, $username, $password, $dbname);
// Retrieve user's first name and last name from database
$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT * FROM alumni_details WHERE id = '$user_id'");
$row = $result->fetch_assoc();
$_SESSION['first_name'] = $row['first_name'];
$_SESSION['last_name'] = $row['last_name'];
$_SESSION['email'] = $row['email'];
$_SESSION['password'] = $row['password'];
$_SESSION['id'] = $row['id'];
$_SESSION['rollno'] = $row['roll_no'];

// Close database connection
$conn->close();
?>
<!--
<!DOCTYPE html>
<html>

<head>
  <title>Dashboard</title>
  <link rel="stylesheet" type="text/css" href="style2.css">
</head>

<body>
  <div class="container">
    <h1>Welcome, <span>

    </span></h1>
    <p>What would you like to do?</p>
    <div class="button-container">
      <a href="AlumniAddCompany.php"><button> Starting a new job? </button></a>
      <a href="EndCurrentJob.php"><button> Ending your current job? </button></a>
      <a href="AlumniUpdateAccount.php"><button> Update account details </button></a>
      <a href="SeeOthers.php"><button> See others from IITP </button></a>
      <a href="Alumnidelete.php"><button onclick="return confirmDelete()">Delete Account</button></a>
      <a href="logout.php"><button onclick="return confirmLogout()">Logout</button></a>
      <a href="Experiences.php"><button>Previous Experiences</button></a>
    </div>
    <script>
      function confirmDelete() {
        if (confirm("Are you sure you want to delete this user's data?")) {
          return true;
        } else {
          return false;
        }
      }

      function confirmLogout() {
        if (confirm("Are you sure you want to Logout?")) {
          return true;
        } else {
          return false;
        }
      }
    </script>
  </div>
</body>

</html>
    -->
<!DOCTYPE html>
<html style="font-size: 16px;" lang="en">

<head>
  <title>Home</title>
  <link rel="stylesheet" href="nicepage.css" media="screen">
  <link rel="stylesheet" href="home.css" media="screen">
  <script class="u-script" type="text/javascript" src="jquery.js" defer=""></script>
  <script class="u-script" type="text/javascript" src="nicepage.js" defer=""></script>
  <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
  <link id="u-page-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i">

</head>

<body class="u-body u-xl-mode" data-lang="en">
  <header class="u-clearfix u-container-align-center u-header u-header" id="sec-86cc">
    <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
      <nav class="u-menu u-menu-one-level u-offcanvas u-menu-1">
        <div class="u-custom-menu u-nav-container">
          <ul class="u-nav u-unstyled u-nav-1">
            <li class="u-nav-item"><a onclick="return confirmLogout()" class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="logout.php" style="padding: 10px 20px;">Logout</a>
            </li>
            <li class="u-nav-item"><a onclick="return confirmDelete()" class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="Alumnidelete.php" style="padding: 10px 20px;">Delete account</a>
            </li>
            <li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="AlumniUpdateAccount.php" style="padding: 10px 20px;">Update Account</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </header>
  <section class="u-clearfix u-container-align-center u-section-1" id="sec-2c54">
    <div class="u-clearfix u-sheet u-sheet-1">
      <div class="u-clearfix u-expanded-width u-layout-wrap u-layout-wrap-1">
        <div class="u-layout">
          <div class="u-layout-row">
            <div class="u-container-align-center-sm u-container-align-center-xs u-container-style u-layout-cell u-size-30 u-layout-cell-1">
              <div class="u-container-layout u-container-layout-1">
                <h1 class="u-align-center-sm u-align-center-xs u-text u-text-default u-text-1">Welcome <?php echo $_SESSION['first_name'] . " " . $_SESSION['last_name']; ?></h1>
              </div>
            </div>
            <div class="u-container-style u-layout-cell u-size-30 u-layout-cell-2">
              <div class="u-container-layout u-valign-bottom-md u-valign-bottom-sm u-valign-bottom-xs u-container-layout-2">
                <img class="u-expanded-width u-image u-image-contain u-image-default u-image-1" src="images/iitp_logo.jpg" alt="" data-image-width="741" data-image-height="903" data-animation-name="customAnimationIn" data-animation-duration="2000">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="u-clearfix u-container-align-center u-palette-2-base u-section-2" id="sec-d516">
    <div class="u-clearfix u-sheet u-sheet-1">
      <h2 class="u-align-center u-text u-text-default u-text-1">What would you like to do?<br>
      </h2>
      <div class="u-list u-list-1">
        <div class="u-repeater u-repeater-1">
          <div class="u-container-align-center u-container-style u-list-item u-radius-50 u-repeater-item u-shape-round u-white u-list-item-1">
            <div class="u-container-layout u-similar-container u-container-layout-1"><span class="u-align-center u-file-icon u-icon u-icon-circle u-palette-1-base u-icon-1" data-animation-name="customAnimationIn" data-animation-duration="2000"><img src="images/3483089.png" alt=""></span>
              <a href="AlumniAddCompany.php" class="u-align-center u-btn u-button-style u-palette-1-base u-btn-1">Starting a new job?</a>
            </div>
          </div>
          <div class="u-container-align-center u-container-style u-list-item u-radius-50 u-repeater-item u-shape-round u-white u-list-item-2">
            <div class="u-container-layout u-similar-container u-container-layout-2"><span class="u-align-center u-file-icon u-icon u-icon-circle u-palette-1-base u-icon-2" data-animation-name="customAnimationIn" data-animation-duration="2000"><img src="images/356749.png" alt=""></span>
              <a href="EndCurrentJob.php" class="u-align-center u-btn u-button-style u-palette-1-base u-btn-2">Ending your current job?</a>
            </div>
          </div>
          <div class="u-container-align-center u-container-style u-list-item u-radius-50 u-repeater-item u-shape-round u-white u-list-item-3">
            <div class="u-container-layout u-similar-container u-container-layout-3"><span class="u-align-center u-file-icon u-icon u-icon-circle u-palette-1-base u-icon-3" data-animation-name="customAnimationIn" data-animation-duration="2000"><img src="images/2058768.png" alt=""></span>
              <a href="SeeOthers.php" class="u-align-center u-btn u-button-style u-palette-1-base u-btn-3">See others from IITP</a>
            </div>
          </div>
          <div class="u-container-align-center u-container-style u-list-item u-radius-50 u-repeater-item u-shape-round u-white u-list-item-4">
            <div class="u-container-layout u-similar-container u-container-layout-4"><span class="u-align-center u-file-icon u-icon u-icon-circle u-palette-1-base u-icon-4" data-animation-name="customAnimationIn" data-animation-duration="2000"><img src="images/10019668.png" alt=""></span>
              <a href="Experiences.php" class="u-align-center u-btn u-button-style u-palette-1-base u-btn-4">Previous experiences</a>
            </div>
          </div>

        </div>
      </div>
      <script>
      function confirmDelete() {
        if (confirm("Are you sure you want to delete this user's data?")) {
          return true;
        } else {
          return false;
        }
      }

      function confirmLogout() {
        if (confirm("Are you sure you want to Logout?")) {
          return true;
        } else {
          return false;
        }
      }
    </script>
    </div>
  </section>
</body>

</html>