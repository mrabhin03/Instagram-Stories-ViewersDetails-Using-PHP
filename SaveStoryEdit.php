<?php
//Saving the changes made in Stories details
    include('Connections.php');
    include('session.php');
    $Mode=$_GET['Mode'];
    if($Mode==0){
        $UserId=$_GET['UserID'];
        $Data=$_GET['Message'];
        $Date=$_GET['Date'];
        $updateName="UPDATE story SET StoryName='$Data', Date='$Date' WHERE StoryID='$UserId'";
        $conn->query($updateName);
    }else{
        $_SESSION['StoryID']=$_GET['UserID'];
    }

?>