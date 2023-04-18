<!DOCTYPE html>
<html>

<head>
    <title>Company Registration Form</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <?php
    $check1;
    $check2;
    function redirect($url)
    {
        header('Location: ' . $url);
        exit();
    }
    $CompanyName = $_POST['CompanyName'];
    $Password = $_POST['password'];
    $Email = $_POST['email'];
    $RecruitingSince = $_POST['RecruitingSince'];
    $HRName = $_POST['HRName'];
    $HRContact = $_POST['HRContact'];
    mysqli_report(MYSQLI_REPORT_OFF);
    $conn = new mysqli('localhost', 'root', '', 'iitp_tpc');
        if ($conn->connect_error) {
            die('Connection Failed :' . $conn->connect_error);
        } else {
            $stmt = $conn->prepare("insert into company_details (company_name,hr_name,hr_contact,email,password,recruiting_since) values(?,?,?,?,?,?)");
            $stmt->bind_param("ssisss", $CompanyName, $HRName, $HRContact, $Email, $Password, $RecruitingSince);
            $stmt->execute();
            $stmt->close();
            $conn->close();
            redirect('Companylogin.php');
        }

    ?>
</body>

</html>