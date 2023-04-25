
<!DOCTYPE html>
<html>
  <head>
    <title>Alumni Directory</title>

    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
  }
  
  .container {
    max-width: 1200px;
    margin: 0 auto;
    margin-bottom: 10px;
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
    padding: 10px;
    text-align: center;
  }
  input[type='number']{
    width: 30%;
    padding: 10px;
    margin-bottom: 15px;
    font-size: 18px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
    position: relative;
    left: 425px;
  }
  label {
    display: block;
    margin-bottom: 10px;
    font-size: 18px;
    color: #666;
    text-align: center;
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
      <h1>Registered Students</h1>
      <form id="alumni-form" action="viewstud.php" method="POST">
        <label for="year">Enter Batch year:</label>
        <input type="number" id="year" name="year" required>
        </select>
        <button type="submit">Submit</button>
      </form>
    </div>
    <?php
		if(isset($_POST['year'])) {
			$year = $_POST['year'];

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
			$sql = "SELECT Name,Roll_Number,Specialization,CPI from student_details where Passing_Year = '$year'";
            $q2 = "SELECT count(*) as count from student_details where Passing_year = '$year'";
            $rs = mysqli_query($conn, $q2);
            $r2 = mysqli_fetch_assoc($rs);
			$result = mysqli_query($conn, $sql);
			// Display the results in a table
            echo '<h1>'. "Total Students Registered in Placement season " .$year.": " . $r2["count"].'</h1>';
			echo '<table>';
			echo '<tr><th>Student Name</th><th>Roll Number</th><th>Branch</th><th>Email</th><th>CPI</th></tr>';
			while($row = mysqli_fetch_assoc($result)) {
                $roll = $row['Roll_Number'];
                $query = "SELECT Email from student_login where Roll_Number = '$roll'";
                $rslt = mysqli_query($conn, $query);
                $row1 = mysqli_fetch_assoc($rslt);
				echo '<tr>';
				echo '<td>'.$row['Name'].'</td>';
				echo '<td>'.$row['Roll_Number'].'</td>';
				echo '<td>'.$row['Specialization'].'</td>';
				echo '<td>'.$row1['Email'].'</td>';
                echo '<td>'.$row['CPI'].'</td>';
				echo '</tr>';
			}
			echo '</table>';
			// Close the database connection
			mysqli_close($conn);
		}
	?>
  </body>
</html>
<script>
      var year = "<?php echo $year ?>";
    document.getElementById("year").value = year;
  </script>