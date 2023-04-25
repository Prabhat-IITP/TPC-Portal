
<!DOCTYPE html>
<html>
  <head>
    <title>Placement Updation Form</title>
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
    padding: 10px;
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
      <h1>Placement Updation Form</h1>
      <form id="alumni-form" action="update_placement2.php" method="POST">
        <label for="company">Select Company:</label>
        <select name="company" id="company">
          <?php
            //Connect to database
            $conn = mysqli_connect("localhost", "root", "", "iitp_tpc");

            //Select company names from Company table
            $result = mysqli_query($conn, "SELECT company_name FROM company_details");

            //Output options for each company name
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<option value=\"" . $row["company_name"] . "\">" . $row["company_name"] . "</option>";
            }
            //Close database connection
            mysqli_close($conn);
          ?>
        </select>
        <button type="submit">Submit</button>
      </form>
    </div>
    <h1>Selected Students</h1>
    <?php
    function myAlert($msg, $url){
        echo '<script language="javascript">alert("'.$msg.'");</script>';
        echo "<script>document.location = '$url'</script>";
         }
		if(isset($_POST['company'])) {
			$company = $_POST['company'];
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
            $query1 = "SELECT roll_no,name,CTC,Profile from job_offered where company_name = '$company'";
            $rslt1 = mysqli_query($conn, $query1);
			// Query to get the alumni details from the database for the selected company
			echo '<table>';
			echo '<tr><th>Name</th><th>roll Number</th><th>Annual CTC</th><th>Job Profile</th></tr>';
			while($row = mysqli_fetch_assoc($rslt1)) {
				echo '<tr>';
				echo '<td>'.$row['name'].'</td>';
				echo '<td>'.$row['roll_no'].'</td>';
				echo '<td>'.$row['CTC'].'</td>';
				echo '<td>'.$row['Profile'].'</td>';
				echo '</tr>';
			}
			echo '</table>';
      echo "</div>";
      echo "<form method='POST' action=update_placement2.php>
      <input type=hidden name=update value=".$company." >
      <button type=submit>Update Placed Studnets</button>
      </form>";
			// Close the database connection
			mysqli_close($conn);
    }
    if(isset($_POST['update'])){
        $company = $_POST['update'];
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
            $query1 = "SELECT roll_no,name,CTC,Profile from job_offered where company_name = '$company'";
            $rslt1 = mysqli_query($conn, $query1);
            while($row = mysqli_fetch_assoc($rslt1)) {
                $CTC = $row["CTC"];
                $role = $row["Profile"];
                $roll = $row["roll_no"];
            $query2 = "UPDATE student_placed set Company = '$company',Annual_CTC = '$CTC',Role = '$role' where Roll_Number = '$roll'";
            $rslt2 = mysqli_query($conn, $query2);
            if(!$rslt2){
                echo "something went wrong";
            }
            }
            myAlert("Placement details Updated", "update_placement2.php");
            // Close the database connection
			mysqli_close($conn);
    }

	?>
  </body>
</html>
<script>
      var company = "<?php echo $company ?>";
    document.getElementById("company").value = company;
  </script>