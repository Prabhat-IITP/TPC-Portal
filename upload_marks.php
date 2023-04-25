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
  <h1>Select Semester</h1>
  <div class="Cntr">
      <form id="semester" action="upload.php" method="GET">
        <select name="semester" id="semester">
        <option value="1">Semester 1</option>
        <option value="2">Semester 2</option>
        <option value="3">Semester 3</option>
        <option value="4">Semester 4</option>
        <option value="5">Semester 5</option>
        <option value="6">Semester 6</option>
        <option value="7">Semester 7</option>
        <option value="8">Semester 8</option>
        </select>
            <button type="submit">Submit</button>
      </form>
    </div>
  
</body>
</html>