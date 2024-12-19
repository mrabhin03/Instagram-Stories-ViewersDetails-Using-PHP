<?php 
//Connection to the database

if (file_exists('../../MainConnection.php')) {
    include('../../MainConnection.php');
} elseif (file_exists('../MainConnection.php')) {
    include('../MainConnection.php');
}

$conn = new mysqli($server_name, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>