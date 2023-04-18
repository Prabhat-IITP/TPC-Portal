
<!DOCTYPE html>
<html>

<head>
  <title>Dashboard</title>
  <link rel="stylesheet" type="text/css" href="style2.css">
</head>

<body>
  <div class="container">
    <h1>For which Profile?</h1>
    <form method="post" action = 'EligibleCandidates.php'>
    <div class="form-group">
                    <label for="ProfileName">Profile Name:</label>
                    <select name="ProfileName" id="ProfileName">
                        <option value="SDE">SDE</option>
                        <option value="Finance">Finance</option>
                        <option value="Management">Management</option>
                        <option value="Core">Core</option>
                        <option value="Others">Others</option>
                    </select>
                    <div class="form-group">
                    <button type="submit">Submit</button>
                </div>
                </div>
	</form>
  </div>

</body>

</html>