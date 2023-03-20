<?php
session_start();
include('server/connection.php');

if (!isset($_SESSION['logged_in'])) {
    header('location: login.php');
    exit;
}

if (isset($_GET['logout'])) {
    if (isset($_SESSION['logged_in'])) {
        unset($_SESSION['logged_in']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_photo']);
        header('location: login.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>asdjkashkhkjf</h1>
    <h2>sddads</h2>
    <h3>faqih</h3>

    <table border = "0" align="center">
        <tr>
            <td rowspan="2"> 
                <img src="foto1.jpg" width="150px" height="150px"> 
            </td> 
            <td>
                <h3>Nama : <?php echo $_SESSION['user_name'] ?> </h3>
            </td>
        </tr>
        <tr>
            <td> 
                <h3>NRP: <?php echo $_SESSION['user_nrp'] ?> </h3>
            </td> 
        </tr>
        <tr>
            <td rowspan="2"></td>
            <td>
                <h3>Kelas : <?php echo $_SESSION['user_kelas']?> </h3>
            </td> 
        </tr>
        <tr>
            <td align="center">
            <a style="color: red;" href="welcome.php?logout=1" id="logout-btn" class="btn btn-danger" 
            style = "color: white;  
            text-decoration: none;
            background-color: black; border-radius: 0%; ">LOG OUT</a>
            </td>
        </tr>
            
    </table>
    
</body>
</html>