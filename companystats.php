
<!DOCTYPE html>
<html>
  <head>
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <title>View Placement Statistics</title>
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
    text-align: center;
  }
  
  select {
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
  
  @media (max-width: 767px) {
    table {
      font-size: 14px;
    }
  }
  #chartContainer {
      height: 370px;
      max-width: 920px;
      margin: 10px auto;
    }
    
        </style>
  </head>
  <body>
    <div class="container">
      <h1>View Branchwise Placement Statistics</h1>
      <form id="alumni-form" action="companystats.php" method="POST">
      <label for="branch">Select Specialization:</label>
		    <select id="branch" name="branch">
        <option value="All">All Branches</option>
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
        <label for="year">Enter year upto which you want to see statistics:</label>
        <input type="number" id="year" name="year" required>
            <button type="submit">Submit</button>
      </form>
    </div>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "iitp_tpc";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      }
      
    // Get the input values from the form
    $company = $_POST['company'];
    $year = $_POST['year'];
    $branch = $_POST['branch'];
    if($branch == 'All'){
    // Retrieve the placement data from the database
    $sql = "SELECT Year, count(Roll_Number)as count FROM student_placed WHERE Company = '$company' AND Year <= '$year' GROUP BY Year";
    $result = mysqli_query($conn,$sql);
    }
    else{
      $sql = "SELECT Year, count(Roll_Number) as count FROM student_placed WHERE Company = '$company' AND Year <= '$year' AND specialization = '$branch' GROUP BY Year";
      $result = mysqli_query($conn,$sql);
    }
    $dataPoints = array();
    foreach ($result as $row) {
        $dataPoints[] = array(
            "label" => $row['Year'],
            "y" => $row['count']
        );
    }
}
  ?>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>

<!-- JavaScript code to create the chart -->
<script>
    var company = "<?php echo $company ?>";
    var year = "<?php echo $year ?>";
    // Set the input field values to the user info
    document.getElementById("company").value = company;
    document.getElementById("year").value = year;
    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        title: {
            text: "Placement Statistics"
        },
        axisX: {
            title: "Year"
        },
        axisY: {
            title: "Number of Students"
        },
        data: [{
            type: "column",
            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();
</script>
  </body>
</html>

