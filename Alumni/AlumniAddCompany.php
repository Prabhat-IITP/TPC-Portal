<!DOCTYPE html>
<html>

<head>
  <title>Add Professional Experiences</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
  <div class="container">
    <h1>Your Professional Experience</h1>
    <form onsubmit= action="AlumniCompanyTable.php" method="post">
      <div class="form-group">
        <label for="CompanyName">Company Name:</label>
        <input type="text" id="CompanyName" name="CompanyName" placeholder="Enter the name of company" required>
      </div>
      <div class="form-group">
        <label for="Position">Position:</label>
        <input type="text" id="Position" name="Position" placeholder="Which position did you work for?" >
      </div>
      <div class="form-group">
        <label for="Location">Location:</label>
        <input type="text" id="Location" name="Location" placeholder="Enter your job location" >
      </div>
      <div class="form-group">
        <label for="JoiningDate">Joining date:</label>
        <input type="date" id="JoiningDate" name="JoiningDate" placeholder="Enter your Joining date" >
      </div>
      <div class="form-group">
        <label for="MonthsWorked">No. of months worked:</label>
        <input type="text" id="MonthsWorked" name="MonthsWorked" placeholder="Enter 'Ongoing' for current job" >
      </div>
      <div class="form-group">
        <label for="CTC">CTC:</label>
        <input type="text" id="CTC" name="CTC" placeholder="What was your CTC? (in lakhs)" >
      </div>
      <div class="form-group">
        <button type="submit">Submit</button>
      </div>
    </form>
  </div>
</body>

</html>