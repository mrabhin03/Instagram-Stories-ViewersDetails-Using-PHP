<?php

include('../CommonFiles/Connections.php');
session_start();
if(isset($_SESSION['UserName'])){
    unset($_SESSION['UserName']);
}
if(isset($_POST['username'])){
    $username1=$_POST['username'];
    $password1=$_POST['password'];
    $password=str_replace("'","",$password1);
    $username=str_replace("'","",$username1);
    $checkSql="SELECT * FROM user WHERE UserName='$username'";
    $result=$conn->query($checkSql);
    if($result->num_rows>0){
        $UserData=$result->fetch_assoc();
        if (password_verify($password, $UserData['Password'])) {
            $_SESSION['UserName']=$username;
            header("location: ../");
        } else {
            $test1=explode("'", $password1);
            $test2=explode("'", $username1);
            
            if(count($test1)>=2||count($test2)>=2){
                echo "<script>alert('SQL Injection Failed')</script>";
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
    <link rel="stylesheet" href="Loginstyle.css">
    <style>
        input[type="text"],
        input[type="password"] {
        border: 1px solid <?php echo (isset($_POST['username']))?"red":"#ccc";?>;
        padding-bottom: ;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <form method="POST">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter username" value="<?php echo (isset($_POST['username']))?$_POST['username']:""; ?>" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter password" value="<?php echo (isset($_POST['password']))?$_POST['password']:""; ?>" required>
            </div>
            <?php
            if(isset($_POST['username']))
            echo "<span style='font-size:14px;color:red;'>Wrong username and password</span>";
            ?>
            <button type="submit" class="login-btn">Login</button>
        </form>
    </div>
</body>
</html>
