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
$sql = "select * from student_placed where Roll_Number = '$Rollno'";
$rslt = mysqli_query($conn,$sql);
$message = "You are not placed currently";
if (mysqli_num_rows($rslt) != 0) {
  $row1 =  mysqli_fetch_array($rslt);
  $company = $row1["Company"];
  $ctc = $row1["Annual_CTC"];
  $role = $row1["Role"];
  $message = "Company : ".$company."<br>"."Role : ".$role."<br>"."Annual CTC : ".$ctc." LPA";
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Student Portal</title>
  <style>
        /* Global styles */
* {
  box-sizing: border-box;
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
}
body {
  background: #323641;
}

.letter-image {
  position: absolute;
  top: 25%;
  left: 25%;
  width: 200px;
  height: 200px;
  -webkit-transform: translate(-50%, -50%);
  -moz-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  cursor: pointer;
}

.animated-mail {
  position: absolute;
  height: 300px;
  width: 400px;
  -webkit-transition: .4s;
  -moz-transition: .4s;
  transition: .4s;
  
  .body {
    position: absolute;
    bottom: 0;
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 0 0 200px 400px;
    border-color: transparent transparent #e95f55 transparent;
    z-index: 2;
  }
  
  .top-fold {
    position: absolute;
    top: 100px;
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 100px 200px 0 200px;
    -webkit-transform-origin: 50% 0%;
    -webkit-transition: transform .4s .4s, z-index .2s .4s;
    -moz-transform-origin: 50% 0%;
    -moz-transition: transform .4s .4s, z-index .2s .4s;
    transform-origin: 50% 0%;
    transition: transform .4s .4s, z-index .2s .4s;
    border-color: #cf4a43 transparent transparent transparent;
    z-index: 2;
  }
  
  .back-fold {
    position: absolute;
    bottom: 0;
    width: 400px;
    height: 200px;
    background: #cf4a43;
    z-index: 0;
  }
  
  .left-fold {
    position: absolute;
    bottom: 0;
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 100px 0 100px 200px;
    border-color: transparent transparent transparent #e15349;
    z-index: 2;
  }
  
  .letter {
    left: 40px;
    bottom: 0px;
    position: absolute;
    width: 320px;
    height: 120px;
    background: white;
    z-index: 1;
    overflow: hidden;
    -webkit-transition: .4s .2s;
    -moz-transition: .4s .2s;
    transition: .4s .2s;
    
    .letter-border {
      height: 20px;
      width: 200%;
      background: repeating-linear-gradient(
        -45deg,
        #cb5a5e,
        #cb5a5e 8px,
        transparent 8px,
        transparent 18px
      );
    }
    
    .letter-title {
      margin-top: 20px;
      margin-left: 20px;
      height: 20px;
      width: 90%;
      color: brown;
      text-align: center;
    }
    .letter-context {
      margin-top: 20px;
      margin-left: 10px;
      height: 20px;
      width: 95%;
      text-align: center;
    }
  }
}

  .letter-image:hover {
    .animated-mail {
      transform: translateY(50px);
      -webkit-transform: translateY(50px);
      -moz-transform: translateY(50px);
    }
    
    .animated-mail .top-fold {
      transition: transform .4s, z-index .2s;
      transform: rotateX(180deg);
      -webkit-transition: transform .4s, z-index .2s;
      -webkit-transform: rotateX(180deg);
      -moz-transition: transform .4s, z-index .2s;
      -moz-transform: rotateX(180deg);
      z-index: 0;
    }
    
    .animated-mail .letter {
      height: 360px;
    }
    
    .shadow {
      width: 500px;
    }
  }
body {
  background-color: #f2f2f2;
}

/* Header styles */
header {
  background-color: #333;
  color: #fff;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem;
}

header h1 {
  font-size: 2rem;
  margin: 0;
}

nav ul {
  display: flex;
  list-style: none;
}

nav ul li {
  margin-left: 1rem;
}

nav ul li:first-child {
  margin-left: 0;
}

nav ul li a {
  color: #fff;
  text-decoration: none;
  padding: 0.5rem;
}

nav ul li a:hover {
  background-color: #fff;
  color: #333;
}

/* Main content styles */
main {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  flex-wrap: wrap;
  padding: 2rem;
}

section {
  background-color: #fff;
  border-radius: 0.5rem;
  box-shadow: 0 2px 4px rgba(0,0,0,0.2);
  flex-basis: calc(50% - 1rem);
  margin-bottom: 2rem;
  padding: 1rem;
}

section h2 {
  font-size: 1.5rem;
  margin-bottom: 0.5rem;
}

section p {
  margin-bottom: 0.5rem;
}
.line {
    display: block;
    justify-content: space-between;
    align-items: center;
    margin: 2% 5%;
}
  
.line .side1 {
    padding: 50px;
}
  
.side1 h1 {
    text-align: center;
    font-size: 60px;
    margin-bottom: 10px;
    color: brown;
}
  
  /* Section styles */
section {
  background-color: #f2f2f2;
  border-radius: 5px;
  padding: 1rem;
  margin-bottom: 1rem;
}

/* Hoverable section styles */
.hoverable {
  transition: background-color 0.3s ease;
}

.hoverable:hover {
  background-color: #e1e1e1;
}

/* Section link styles */
.section-link {
  text-decoration: none;
  color: inherit;
  cursor: pointer;
}
.side2{
  position: absolute;
  top: 40%;
  right: 25%;
  transform: translateY(-50%);
  width: 100px;
  height: 100px;
}
.container {
			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: center;
			min-height: 100vh;
		}

		.box {
			background-color: #fff;
			border-radius: 10px;
			box-shadow: 0px 2px 10px rgba(0,0,0,0.15);
			padding: 20px;
			width: 300px;
			height: 240px;
			position: fixed;
			bottom: 20px;
			right: 20px;
		}

		h2 {
			font-size: 20px;
			font-weight: bold;
			margin-bottom: 10px;
		}

		table {
			border-collapse: collapse;
			width: 100%;
			margin-top: 10px;
		}

		table td, table th {
			border: 1px solid #ddd;
			padding: 8px;
			text-align: center;
		}

		table th {
			background-color: #f2f2f2;
			color: #333;
			font-weight: bold;
		}

		.close {
			position: absolute;
			top: 5px;
			right: 10px;
			cursor: pointer;
			color: #ccc;
			font-size: 20px;
			transition: color 0.2s ease;
		}

		.close:hover {
			color: #333;
			text-decoration: none;
		}
</style>
</head>
<body>
  <header>
    <h1>Training and Placement Cell</h1>
    <nav>
      <ul>
        <li><a href="update.php">Update Details</a></li>
        <li><a href="alumni.php">Connect with Alumni</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>
  <main>
  <div class="line" id="Home">
        <div class="side1">
            <h1>Welcome <?php echo $Rollno?>!</h1>
            <h2>Oppurtunities are waiting for you!</h2>
        </div>
        <div>
          <div class ="side2">
        <div class="letter-image">
  <div class="animated-mail">
    <div class="back-fold"></div>
    <div class="letter">
      <div class="letter-title">
      <h2>Placement Status</h2>
      </div>
      <div class="letter-context">
        <h3><?php echo $message?></h3> 
    </div>
    </div>
    <div class="top-fold"></div>
    <div class="body"></div>
    <div class="left-fold"></div>
  </div>
</div>
</div>
    <a href="companies.php" class="section-link">
      <section class="hoverable">
        <h2>View Companies</h2>
        <p>Here you can view companies that are hiring.</p>
      </section>
    </a>
    <a href="upload_academic.php" class="section-link">
      <section class="hoverable">
        <h2>Upload Academic Details</h2>
        <p>Update your academic details here.</p>
      </section>
    </a>
    <a href="companystats.php" class="section-link">
      <section class="hoverable">
        <h2>View Company wise Statistics</h2>
        <p>See the trend of placement company and year wise.</p>
      </section>
    </a>
</div>
<div class="box">
			<span class="close">&times;</span>
			<h2>Top 3 Salary Offering Companies This Year</h2>
			<table>
				<thead>
					<tr>
						<th>Company</th>
						<th>Salary</th>
					</tr>
				</thead>
				<tbody>
					<?php
						// Connect to database and retrieve top 3 salary offering companies
						$servername = "localhost";
						$username = "root";
						$password = "";
						$dbname = "iitp_tpc";

						$conn = mysqli_connect($servername, $username, $password, $dbname);

						if (!$conn) {
							die("Connection failed: " . mysqli_connect_error());
						}

						$sql = " SELECT company_name, max(CTC) as max_ctc FROM company_jobs INNER JOIN company_details ON company_jobs.c_id = company_details.id GROUP BY c_id ORDER BY max_ctc DESC LIMIT 3";
						$result = mysqli_query($conn, $sql);

						if (mysqli_num_rows($result) > 0) {
							while($row = mysqli_fetch_assoc($result)) {
								echo "<tr><td>" . $row["company_name"]. "</td><td>" . $row["max_ctc"] . " LPA"."</td></tr>";
							}
						} else {
							echo "<tr><td colspan='2'>No data found</td></tr>";
						}

						mysqli_close($conn);
					?>
				</tbody>
			</table>
		</div>
  </main>
</body>
</html>
<script type="text/javascript">
  const closeButton = document.querySelector(".close");
const box = document.querySelector(".box");

closeButton.addEventListener("click", () => {
  box.style.display = "none";
});
</script>