<!DOCTYPE html>
<html>
  <head>
    <title>Company Login Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
  <div class="container">
    <div class="form-container">
  <h1>Company Login Page</h1>
    <form method="POST" action="CompanyVerification.php">
      <div class="form-group">
          <label for="email">Email*:</label>
          <input type="email" id="email" name="email" placeholder="Enter your email id" required>
        </div>
        <div class="form-group">
          <label for="password">Password*:</label>
          <input type="text" id="password" name="password" placeholder="Enter your password" required>
        </div>
        <div class="form-group">
          <button type="submit">Submit</button>

        </div>
        </div>
        </div>
    </form>
  </body>
</html>
