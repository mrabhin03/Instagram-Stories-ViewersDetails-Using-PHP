<?php
//User data Table
include('Connections.php');
include('session.php');
$storyID=$_SESSION['StoryID'];

$Mode= $_GET['Mode'];
if($Mode==0){
    $userssql="SELECT * FROM users ORDER BY Sort";
}elseif($Mode==1){
    $userssql="SELECT * FROM users INNER JOIN  viewers ON users.UserID=viewers.UserID WHERE viewers.StoryID=$storyID ORDER BY viewers.ViewID DESC";
}elseif($Mode==2){
    $userssql="SELECT * FROM users LEFT JOIN viewers ON users.UserID = viewers.UserID AND viewers.StoryID = $storyID WHERE viewers.UserID IS NULL ORDER BY users.UserID;";
}elseif($Mode==3){
    $userssql="SELECT * FROM users WHERE Status=0 ORDER BY Sort";
}elseif($Mode==4){
    $Search= $_GET['Value'];
    $userssql="SELECT * FROM users WHERE UserName LIKE '%$Search%' ORDER BY Sort";
}



$usersda=$conn->query($userssql);
if($usersda->num_rows>0){
    $jur=1;
    while($userdata=$usersda->fetch_assoc()){
        $UserName=$userdata['UserName'];
        if($Mode==4){
            // $UserName = str_replace($Search, "<b>$Search</b>", $UserName);
            $UserName = preg_replace('/' . preg_quote($Search, '/') . '/i', '<b id="Searchresult">$0</b>', $UserName);
        }
        $Links = explode('(', $UserName);
        $Links= $Links[0];
        echo "<tr style='height:50px;'>";
        echo "<td>".$jur."</td>";
        $new=($userdata['Status']==0)?"   <b class='newuser'>(NEW)</b>":"";
        echo "<td style='text-align:left;padding-right:25px;padding-left:10px;min-width:440px;'><a href='https://www.instagram.com/$Links' target='_blank'>".$UserName.$new."</a></td>";
        $check1="SELECT * FROM viewers WHERE UserID='".$userdata['UserID']."' AND StoryID='$storyID'";
        $chr=$conn->query($check1);
        $view="Not Seen";
        if($chr->num_rows>0){
            $view="Seen";
        }
        echo "<td style='padding:10px;min-width:70px;'>".$view."</td>";
        echo "</tr>";
        $jur++;
    }
}else{
    echo "<tr><td style='text-align:center;padding-right:25px;padding-left:10px;min-width:530px;' colspan='3'>NO Data</td></tr>";
}


?>