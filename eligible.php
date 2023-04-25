
<!DOCTYPE html>
<html>
  <head>
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <title>View Eligible Students</title>
    <style>
          .company {
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 20px;
    margin-bottom: 10px;
    margin-top:10px;
    box-shadow: 0px 2px 4px rgba(0,0,0,0.1);
  }
  
  .company h2 {
    text-align: center;
    margin-top: 0;
    font-size: 30px;
    color: #333;
    margin-bottom: 5px;
  }
  
  .company p {
    text-align: center;
    margin: 0;
    margin-bottom: 2px;
    font-size: 18px;
    color: #666;
  }
  
  .company p strong {
    color: #333;
  }
  .company:hover {
    background-color: #f2f2f2;
    transition: background-color 0.3s ease;
  }
  
  @media (max-width: 767px) {
    .company {
      width: 100%;
      float: none;
      margin-right: 0;
    }
  }
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
      <h1>View Eligible Students</h1>
      <form id="alumni-form" action="eligible.php" method="POST">
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
        <label for="Role">Select Role:</label>
        <form id="alumni-form" action="companies.php" method="POST">
        <select name="Role" id="Role">
        <option value="SDE">SDE</option>
        <option value="Management">Management</option>
        <option value="Finance">Finance</option>
        <option value="Core">Core</option>
        <option value="Others">Others</option>
        </select>
            <button type="submit">Submit</button>
      </form>
      <?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
$CompanyName = $_POST['company'];
$ProfileName =  $_POST['Role'];
$query = "select id from company_details where company_name = '$CompanyName'";
$result = $conn->prepare($query);
$result->execute();
$res = $result->get_result();
$row = mysqli_fetch_assoc($res);
$c_id  = $row["id"];
// Query the database for the user's information
$sql = "Select * from company_jobs where c_id = $c_id AND profile_name = ? LIMIT 1";
$stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $ProfileName);
        $stmt->execute();
        $result = $stmt->get_result();
$row = mysqli_fetch_assoc($result);
$mincpi = $row['min_cpi'];
$back = $row['back_allowed'];
$gender = $row['gender_specific'];
$branch = $row['branch_specialization'];
     function redirect($url)
     {
         header('Location: ' . $url);
         exit();
     }
     // Query the database for the user's information
     $sql = "SELECT *
     FROM student_details as b
     WHERE  ((? = 'Open') OR (? LIKE CONCAT('%', b.Specialization, '%')))
     AND ((? = 'ForAll' AND (b.Gender = 'Male' OR b.Gender = 'Female')) OR (? = 'Only for girls' AND b.Gender = 'Female')) 
     AND b.CPI > ? 
     AND (? = 1 OR b.back = 0)";
     $stmt = $conn->prepare($sql);
     $stmt->bind_param("ssssds", $branch, $branch, $gender, $gender, $mincpi, $back);
     $stmt->execute();
     $result = $stmt->get_result();
     // Loop through the data and display it in cards
     while ($row = $result->fetch_assoc()) {
        echo "<div class='company'>";
        echo "<h2>" . $row['Name'] . "</h2>";
        echo "<p><strong>Roll Number:</strong> " . $row['Roll_Number'] . "</p>";
        echo "<p><strong>Specialization:</strong> " .$row['Specialization'] ."</p>";
        echo "</div>";
    }
}
?>
    </div>