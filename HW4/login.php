<?php
session_start();

$error = "";
if($_POST){
    require_once("dbconfig.php");

    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * 
            FROM staff
            WHERE username = ? AND passwd = md5 (?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('ss',$username,$password);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $_SESSION['stf_name'] = $row['stf_name'];
        $_SESSION['is_admin'] = $row['is_admin'];
        $_SESSION['loggined'] = true;
        header ('location: documents.php');
    }else{
        $error = 'Username or password is incorrect';
    }
}

?>
<!DOCTYPE html>
<htkl lang = "en">
    <head>
        <meta charset = "UTF-8">
        <meta http-equiv = "X-UA-Comatible" content = "IE = edge">
        <meta name = "viewport" content = "wideth = device-with, intial-scale = 1.0">
        <title>login</title>
    </head>

    <body style = "background-color:#CCFF99" align = center >
        <h1 >Login</h1>
        <form action = "login.php" method = "post">
            <label for = "username">Username:</label>
            <input type = "text" name = "username" id = "username"  style = "background-color:#CCFFFF" >
            <br><br>
            <label for = "password">Password:</label>
            <input type = "password" name = "password" id = "password"  style = "background-color:#CCFFFF">
            <br><br>
            <input  type = "submit" value = "Login" name = "submit"style = "background-color:#20B2AA">
        </form> 
        <div style = "">
            <?php  echo $error; ?>
        </div>
    </body>