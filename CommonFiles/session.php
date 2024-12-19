<?php
//Session check
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['UserName'])){
    header('location:Login');
}
?>