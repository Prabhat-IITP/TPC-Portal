<!DOCTYPE html>
<html>
<head>
  <title>company</title>
  <style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
  }
  
  h1 {
    text-align: center;
    color: #333;
    margin-top: 50px;
  }
  
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

  h1 {
    text-align: center;
    color: #333;
    margin-top: 0;
  }
  .Cntr {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0px 2px 4px rgba(0,0,0,0.1);
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
  
    </style>
</head>
<body>
  <h1>You Are Eligible to Apply in the following companies!</h1>
  <div class="Cntr">
      <h1>Select Role you are looking for:</h1>
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
    </div>
  <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
  function myAlert($msg, $url){
    echo '<script language="javascript">alert("'.$msg.'");</script>';
    echo "<script>document.location = '$url'</script>";
     }
  session_start();
  if (!isset($_SESSION['sess_user'])) { 
    header("location: login.php");
  }
    $conn = mysqli_connect("localhost","root","","iitp_tpc");
    $Rollno = $_SESSION['sess_user'];
    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    $query = "SELECT * FROM student_details WHERE Roll_Number = '$Rollno'";
    $rslt = mysqli_query($conn, $query);
     $row =  mysqli_fetch_array($rslt);
     $cpi = $row["CPI"];
     $back = $row["Back"];
     $gender = $row["Gender"];
     $branch = $row["Specialization"];
     $batch = $row["Passing_Year"];
     if(!$cpi){
      myAlert("Please upload academic details to view companies in which you are eligible.", "dashboard.php");
     }
    // Query to get companies
    $role = $_POST["Role"];
    $sql = "SELECT * FROM company_jobs where profile_name = '$role'";
    $result = mysqli_query($conn, $sql);
    
    // Check if there are any companies
    if (mysqli_num_rows($result) > 0) {
      // Output each company's details
      while ($row = mysqli_fetch_assoc($result)) {
        $error = 0;
        if($row["min_cpi"] > $cpi){
          $error = 1;
        }
        if($row["back_allowed"] == "NO" && $back == 1){
          $error = 1;
        }
        if($row["gender_specific"] != "ForAll" && $gender == 'M'){
          $error = 1;
        }
        $br = $row["branch_specialization"];
        $rst = mysqli_query($conn,"select locate('$branch','$br',1) as loc");
        $r5 = mysqli_fetch_assoc($rst);
        if($r5["loc"] == 0){
          $error = 1;
        }
        $company_ctc = $row["CTC"];
        $sql2 = "select * from student_placed where Roll_Number = '$Rollno'";
        $rsl = mysqli_query($conn,$sql2);
        if (mysqli_num_rows($rsl) > 0) {
          $row1 =  mysqli_fetch_array($rsl);
          $ctc = $row1["Annual_CTC"];
          if($company_ctc <= $ctc){
            $error = 1;
          }
        }
        if($error == 0){
          $cid = $row["c_id"];
          $q = "select company_name from company_details where id = '$cid'";
          $r = mysqli_query($conn, $q);
          $r1 = mysqli_fetch_assoc($r);
          $company = $r1["company_name"];
        echo "<div class='company'>";
        echo "<h2>" . $company . "</h2>";
        echo "<p><strong>CTC:</strong> " . $row['CTC'] . " LPA</p>";
        echo "<p><strong>Job Location:</strong> " . $row['job_location']."</p>";
        echo "</div>";
        }
      }
    } else {
      echo "No companies found.";
    }
    
    // Close connection
    mysqli_close($conn);
  }
  ?>
  
</body>
</html>