<!DOCTYPE html>
<html>

<head>
  <title>Dashboard</title>
  <link rel="stylesheet" type="text/css" href="style2.css">
</head>

<body>
  <div class="container">
    <h1>Please insert the required query</h1>
    <form method="post" action="ExecuteQuery.php">
		<label for="text">Enter query: </label>
		<input type="text" id="query" name="query">
		<input type="submit" name="submit" value="Submit">
	</form>
  </div>

</body>

</html>