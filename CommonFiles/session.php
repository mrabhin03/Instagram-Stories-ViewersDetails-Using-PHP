<?php
//Session check
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_COOKIE['UserID'])){
    header('location:Login');
}else{
    $_SESSION['UserID']=$_COOKIE['UserID'];
}

?>