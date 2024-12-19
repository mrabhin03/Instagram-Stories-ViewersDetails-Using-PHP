<?php
//Stories a user seen and not seen
include('CommonFiles/Connections.php');
include('CommonFiles/session.php');
$UserID=$_GET['details'];
$userssql="SELECT * FROM users WHERE UserID='$UserID'";
$usersda=$conn->query($userssql)->fetch_assoc();
$new=($usersda['Status']==0)?"   <b class='newuser'>(NEW)</b>":"";
$UserName=$usersda['UserName'];
$Links = explode('(', $UserName);
$Links= $Links[0];
$usersupdatesql="UPDATE `users` SET `Status`='1' WHERE UserID='$UserID'";
$conn->query($usersupdatesql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="Style/style.css?v=<?php echo time();?>">
    <title>Story Viewers</title>
</head>
<body>
<?php 
    ?>
    <h1><a href="https://www.instagram.com/<?php echo $Links;?>" target='_blank'><?php echo $usersda['UserName'].$new; ?></a></h1>
    <p id="Output"></p>
    <form id="ViewFormData">
        <table>
            <thead>
                <th>SI NO</th>
                <th>Story Name </th>
                <th>Date</th>
                <th>Seens</th>
            </thead>
            <tbody>
                <?php
                $Storysql="SELECT * FROM `story` ORDER BY StoryID DESC";
                $Stories=$conn->query($Storysql);
                if($Stories->num_rows>0){
                    $viewsd=0;
                    $jur=1;
                    while($Storiesdata=$Stories->fetch_assoc()){
                        $StoriesName=$Storiesdata['StoryName'];

                        $check1="SELECT * FROM viewers WHERE UserID='".$UserID."' AND StoryID='".$Storiesdata['StoryID']."'";
                        $chr=$conn->query($check1);
                        $view="Not Seen";
                        $colr="color:red;";
                        if($chr->num_rows>0){
                            $view="Seen";
                            $colr="";
                            $viewsd++;
                        }


                        ?>
                        <tr style="<?php echo $colr; ?>">
                        <td ><?php echo $jur;?>
                        <td style='text-align:left;padding:8px 15px 8px 15px;min-width:440px;'><?php echo $StoriesName;?></td>
                        <td style='padding:5px 10px 5px 10px;'><?php echo $Storiesdata['Date'];?></td>
                        <td style='padding:10px 10px 10px 10px;'><?php echo $view;?></td>
                        </tr>
                        <?php
                        $jur++;
                    }
                    echo "<tr><td colspan='3'>Total Stories Viewed</td><td>($viewsd/".($jur-1).")</td></tr>";
                }else{
                    echo "<tr><td style='text-align:center;padding-right:25px;padding-left:10px;min-width:530px;' colspan='3'>NO Data</td></tr>";
                }
                ?>
            </tbody>
        </table> 
    </form>
</body>
</html>