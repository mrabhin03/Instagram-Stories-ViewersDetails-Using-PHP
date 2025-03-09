<?php
include('../CommonFiles/Connections.php');
include('../CommonFiles/session.php');
    $UserID1= $_GET['Value1'];
    $UserID2= $_GET['Value2'];
    $User1="SELECT UserName FROM `users` WHERE UserID='$UserID1' LIMIT 1";

    $Data1=$conn->query($User1);
    if($Data1->num_rows==0){
        die("<span style='padding:10px 20px;background-color:red;color:white;border-radius:8px;'>Invalid Input</span>");
    }
    $User2="SELECT UserName FROM `users` WHERE UserID='$UserID2' LIMIT 1";
    $Data2=$conn->query($User2);
    if($Data2->num_rows==0){
        die("<span style='padding:10px 20px;background-color:red;color:white;border-radius:8px;'>Invalid Input</span>");
    }
    $user1Datav=$Data1->fetch_assoc();
    $user2Datav=$Data2->fetch_assoc();

    $UserName1=$user1Datav['UserName'];
    $UserName2=$user2Datav['UserName'];

    
    if($UserID1<$UserID2){
        $UserNameChange="UPDATE `users` SET `UserName`='$UserName2' WHERE `UserID`='$UserID1'";
        $StoryUpdate="UPDATE `viewers` SET `UserID`='$UserID1' WHERE `UserID`='$UserID2'";
        $DeleteUser="DELETE FROM `users` WHERE `UserID`='$UserID2'";
    }else{
        $UserNameChange="UPDATE `users` SET `UserName`='$UserName1' WHERE `UserID`='$UserID2'";
        $StoryUpdate="UPDATE `viewers` SET `UserID`='$UserID2' WHERE `UserID`='$UserID1'";
        $DeleteUser="DELETE FROM `users` WHERE `UserID`='$UserID1'";
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