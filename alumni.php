
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
      <h1>Alumni Directory</h1>
      <form id="alumni-form" action="alumni.php" method="POST">
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
        <label for="search">Search By:</label>
        <select name="search" id="search">
        <option value="All">All Entries</option>
        <option value="email">Email</option>
        <option value="months_worked">Months Worked</option>
        <option value="position">position</option>
        <option value="location">Location</option>
          </select>
          <label for="field">Search For:</label>
          <input type="text" id="field" name="field" >
        <button type="submit">Submit</button>
      </form>
    </div>
    <?php
		if(isset($_POST['company'])) {
			$company = $_POST['company'];
      $field = $_POST['field'];
      $search = $_POST['search'];
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
     if($search == 'All'){
            $query1 = "SELECT position,location,months_worked from alumni_company_details where company_name = '$company'";
            $rslt1 = mysqli_query($conn, $query1);
			// Query to get the alumni details from the database for the selected company
			$sql = "SELECT first_name, last_name, email FROM alumni_details WHERE id in (SELECT alumni_id from alumni_company_details where company_name = '$company')";
			$result = mysqli_query($conn, $sql);
     }
     else if($search == 'email'){
      $query1 = "SELECT position,location,months_worked from alumni_company_details where company_name = '$company' AND alumni_id in (select id from alumni_details where $search = '$field')";
      $rslt1 = mysqli_query($conn, $query1);
      // Query to get the alumni details from the database for the selected company
      $sql = "SELECT id,first_name, last_name, email FROM alumni_details WHERE id in (SELECT alumni_id from alumni_company_details where company_name = '$company') AND $search = '$field'";
      $result = mysqli_query($conn, $sql);
     }
     else{
      $query1 = "SELECT position,location,months_worked from alumni_company_details where company_name = '$company' AND $search = '$field'";
      $rslt1 = mysqli_query($conn, $query1);
      // Query to get the alumni details from the database for the selected company
      $sql = "SELECT id,first_name, last_name, email FROM alumni_details WHERE id in (SELECT alumni_id from alumni_company_details where company_name = '$company'AND $search = '$field')";
      $result = mysqli_query($conn, $sql);
     }
			// Display the results in a table
			echo '<table>';
			echo '<tr><th>Alumni Name</th><th>Email</th><th>Months worked</th><th>position</th><th>location</th></tr>';
			while($row = mysqli_fetch_assoc($result)) {
                $row1 = mysqli_fetch_assoc($rslt1);
				echo '<tr>';
				echo '<td>'.$row['first_name']." ".$row['last_name'].'</td>';
				echo '<td>'.$row['email'].'</td>';
				echo '<td>'.$row1['months_worked'].'</td>';
				echo '<td>'.$row1['position'].'</td>';
                echo '<td>'.$row1['location'].'</td>';
				echo '</tr>';
			}
			echo '</table>';
      echo "</div>";
			// Close the database connection
			mysqli_close($conn);
    }

	?>
  </body>
</html>
<script>
      var company = "<?php echo $company ?>";
      var field = "<?php echo $field ?>";
      var search = "<?php echo $search ?>";
    document.getElementById("company").value = company;
    document.getElementById("search").value = search;
    document.getElementById("field").value = field;
  </script>