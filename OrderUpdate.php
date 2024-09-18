<?php
include('Connections.php');
$UserId=$_GET['UserID'];
$Start=$_GET['Start'];
$End=$_GET['End'];
if($Start!=$End){
    $Updatesql="";
    if($End>$Start){
        $Arr=$Start+1;
        while($Arr<=$End){
            $Updatesql="UPDATE `users` SET `Sort`=".($Arr-1)." WHERE Sort=$Arr; ";
            $conn->query($Updatesql);
            $Arr++;
        }
    }else{
        $Arr=$Start-1;
        while($Arr>=$End){
            $Updatesql="UPDATE `users` SET `Sort`=".($Arr+1)." WHERE Sort=$Arr; ";
            $conn->query($Updatesql);
            $Arr--;
        }
    }
    $Updatesql="UPDATE `users` SET `Sort`=$End WHERE UserID=$UserId; ";
    $conn->query($Updatesql);
    
}


?>