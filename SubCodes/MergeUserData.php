<?php
//User data Table
include('../CommonFiles/Connections.php');
include('../CommonFiles/session.php');
$Search= $_GET['Value'];
$Mode= $_GET['Mode'];
$userssql="SELECT * FROM users WHERE UserName LIKE '%$Search%' ORDER BY Sort";



$usersda=$conn->query($userssql);
if($usersda->num_rows>0){
    $jur=1;
    while($userdata=$usersda->fetch_assoc()){
        $UserName=$userdata['UserName'];
        $MainUserName=$userdata['UserName'];
            // $UserName = str_replace($Search, "<b>$Search</b>", $UserName);
        if($Search!='')
        $UserName = preg_replace('/' . preg_quote($Search, '/') . '/i', '<b id="Searchresult">$0</b>', $UserName);
        $Links = explode('(', $UserName);
        $Links= $Links[0];
        echo "<tr style='height:20px;'>";
        echo "<td>".$jur."</td>";
        $new=($userdata['Status']==0)?"   <b class='newuser'>(NEW)</b>":"";
        echo "<td style='text-align:left;padding-right:25px;padding-left:10px;width:50px'><a href='https://www.instagram.com/$Links' target='_blank' style='color:white'>".$UserName.$new."</a></td>";
        echo "<td style='padding:10px;min-width:70px;'><input type='radio' name='User' onclick='SelectUser(this,".$Mode.")' value='$MainUserName'></td>";
        echo "</tr>";
        $jur++;
    }
}else{
    echo "<tr><td style='text-align:center;padding-right:25px;padding-left:10px;min-width:530px;' colspan='3'>NO Data</td></tr>";
}


?>