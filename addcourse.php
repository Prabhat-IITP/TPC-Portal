
<?php
function myAlert($msg, $url){
	echo '<script language="javascript">alert("'.$msg.'");</script>';
	echo "<script>document.location = '$url'</script>";
	 }
		if(isset($_POST['id'])) {
      $conn = mysqli_connect("localhost","root","","iitp_tpc");
      $id = $_POST['id'];
     $semester = substr($id,0,1);
     $CCode = substr($id,1);
$table = 'sem'.$semester.'_courses';
$sql = "DELETE FROM $table where CCode = '$CCode'";
$result = mysqli_query($conn, $sql);
myAlert("Course dropped successfully!", "addcourse.php");
    }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>View Courses</title>
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
  }
  
  .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0px 2px 4px rgba(0,0,0,0.1);
  }
  
  h1 {
    text-align: center;
    color: #333;
    margin-top: 0;
  }
  
  form {
    margin-bottom: 20px;
  }
  
  label {
    display: block;
    margin-bottom: 10px;
    font-size: 18px;
    color: #666;
  }
  
  select {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    font-size: 18px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
  }
  
  button[type="submit"] {
    background-color: #333;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin: 0 auto;
    display: block;
  }
  
  button[type="submit"]:hover {
    background-color: #666;
    
  }
  
  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 25px;
  }
  
  th {
    background-color: #333;
    color: #fff;
    font-size: 20px;
    text-align: center;
    padding: 10px;
  }
  
  td {
    border: 1px solid #ccc;
    font-size: 16px;
    padding: 4px;
    text-align: center;
  }
  
  input[type='text']{
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    font-size: 18px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
    position: relative;

  }
  
  @media (max-width: 767px) {
    table {
      font-size: 14px;
    }
  }

  </style>
  </head>
  <body>
    <div class="container">
      <h1>View Courses</h1>
      <form id="view-form" action="addcourse.php" method="POST">
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
        <label for="semester">Semester No:</label>
        <select name="semester" id="semester">
        <option value="1">Semester 1</option>
        <option value="2">Semester 2</option>
        <option value="3">Semester 3</option>
        <option value="4">Semester 4</option>
        <option value="5">Semester 5</option>
        <option value="6">Semester 6</option>
        <option value="7">Semester 7</option>
        <option value="8">Semester 8</option>
        </select>
        <button type="submit">Submit</button>
      </form>
    </div>
    <?php
		if(isset($_POST['branch'])) {
	  $branch = $_POST['branch'];
      $semester = $_POST['semester'];
      $table = 'sem'.$semester.'_courses';
			// Connect to the database
			$dbhost = 'localhost';
			$dbuser = 'root';
			$dbpass = '';
			$dbname = 'iitp_tpc';
			$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
			// Check connection
			if (!$conn) {
			    die("Connection failed: " . mysqli_connect_error());
			}
      $sql = "SELECT Course,Credit,CCode FROM $table WHERE Specialization = '$branch'";
      $result = mysqli_query($conn, $sql);
			// Display the results in a table
			echo '<table>';
			echo '<tr><th>Course</th><th>Course Code</th><th>Credit</th><th>Drop</th></tr>';
			while($row = mysqli_fetch_assoc($result)) {
				echo '<tr>';
				echo '<td>'.$row['Course'].'</td>';
				echo '<td>'.$row['CCode'].'</td>';
				echo '<td>'.$row['Credit'].'</td>';
				echo "<td><form method='POST' action=addcourse.php>
                <input type=hidden name=id value=".$semester.$row["CCode"]." >
                <button type=submit>Drop</button>
                </form>
                </td>";
				echo '</tr>';
			}
			echo '</table>';
      echo "</div>";
      echo "<form method='GET' action=add.php>
                <input type=hidden name=add value=".$semester.$branch." >
                <button type=submit>Add New Course</button>
                </form>";
			// Close the database connection
			mysqli_close($conn);
    }

	?>
  </body>
</html>
<script>
      var semester = "<?php echo $semester ?>";
      var branch = "<?php echo $branch ?>";
    document.getElementById("semester").value = semester;
    document.getElementById("branch").value = branch;
  </script>
