<!DOCTYPE html>
<html>
<head>
  <title>Companies</title>
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
    margin-bottom: 10px;
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
  button[type="submit"]:hover {
    background-color: #666;
    
  }
    </style>
</head>
<body>
  <h1>Companies</h1>
  <div class="Cntr">
      <form id="company-form" action="compan.php" method="POST">
        <label for="year">Enter Placement year:</label>
        <input type="number" id="year" name="year" required>
            <button type="submit">Submit</button>
      </form>
    </div>

  <?php
  function myAlert($msg, $url){
    echo '<script language="javascript">alert("'.$msg.'");</script>';
    echo "<script>document.location = '$url'</script>";
     }
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to database
    $conn = mysqli_connect("localhost", "root", "", "iitp_tpc");
    $year = $_POST['year'];
    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    $curryear = date("Y"); 
    if($year != $curryear){
      $table = 'company_jobs_'.$year;
    }
    else{
      $table = 'company_jobs';
    }
    $query = "SELECT distinct c_id from $table";
    $result = mysqli_query($conn, $query);
    $count = mysqli_num_rows($result);
    if($count == 0){
      myAlert("Please Enter valid Placement year", "compan.php");
    }
    $count = mysqli_num_rows($result);
    echo '<h1>'. "Total Companies Registered in placement season ".$year.": ". $count.'</h1>';
    while ($row = mysqli_fetch_assoc($result)) {
      $id = $row["c_id"];
    $q = "select company_name,hr_name,hr_contact,email from company_details where id = '$id'";
    $r = mysqli_query($conn, $q);
    $r1 = mysqli_fetch_assoc($r);
    echo "<div class='company'>";
    echo "<h2>" . $r1['company_name'] . "</h2>";
    echo "<p><strong>HR Name:</strong> " . $r1['hr_name'] . "</p>";
    echo "<p><strong>HR Contact:</strong> " . $r1['hr_contact'] . "</p>";
    echo "<p><strong>Email:</strong> " . $r1['email'] . "</p>";
    echo "</div>";
    }
    // Close connection
    mysqli_close($conn);
  }
  ?>
  
</body>
</html>

<script>
      var year = "<?php echo $year ?>";
    document.getElementById("year").value = year;
  </script>