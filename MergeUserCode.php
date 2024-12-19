<?php
include('Connections.php');
include('session.php');
    $Value1= $_GET['Value1'];
    $Value2= $_GET['Value2'];
    $User1="SELECT UserID FROM `users` WHERE UserName='$Value1' LIMIT 1";
    $Data1=$conn->query($User1);
    if($Data1->num_rows==0){
        die("<span style='padding:10px 20px;background-color:red;color:white;border-radius:8px;'>Invalid Input</span>");
    }
    $User2="SELECT UserID FROM `users` WHERE UserName='$Value2' LIMIT 1";
    $Data2=$conn->query($User2);
    if($Data2->num_rows==0){
        die("<span style='padding:10px 20px;background-color:red;color:white;border-radius:8px;'>Invalid Input</span>");
    }
    $UserID1=$Data1->fetch_assoc()['UserID'];
    $UserID2=$Data2->fetch_assoc()['UserID'];
    
    if($UserID1>$UserID2){
        $UserNameChange="UPDATE `users` SET `UserName`='$Value2' WHERE `UserName`='$Value1'";
        $StoryUpdate="UPDATE `viewers` SET `UserID`='$UserID2' WHERE `UserID`='$UserID1'";
        $DeleteUser="DELETE FROM `users` WHERE `UserID`='$UserID1'";
    }else{
        $UserNameChange="UPDATE `users` SET `UserName`='$Value1' WHERE `UserName`='$Value2'";
        $StoryUpdate="UPDATE `viewers` SET `UserID`='$UserID1' WHERE `UserID`='$UserID2'";
        $DeleteUser="DELETE FROM `users` WHERE `UserID`='$UserID2'";
    }
    $conn->query($UserNameChange);
    $conn->query($StoryUpdate);
    $conn->query($DeleteUser);
    $OrderReset="SELECT * FROM users ORDER BY Sort";
    $Order=$conn->query($OrderReset);
    $i=1;
    while($row=$Order->fetch_assoc()){
        $ID=$row['UserID'];
        $Update="UPDATE `users` SET `Sort`='$i' WHERE `UserID`='$ID'";
        $conn->query($Update);
        $i++;
    }
    die("<span style='padding:10px 20px;background-color:green;color:white;border-radius:8px;'>Merge Completed</span>");

?>