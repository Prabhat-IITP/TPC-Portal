<!DOCTYPE html>
<html>
  <head>
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
  <div class="container">
    <div class="form-container">
  <h1>Alumni Login Page</h1>
    <form method="POST" action="Verification.php">
      <!--<label for="email">Email:</label>
      <input type="email" id="email" name="email" required>

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>

      <button type="submit">Log In</button> -->
      <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" placeholder="Enter your email id" required>
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
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
