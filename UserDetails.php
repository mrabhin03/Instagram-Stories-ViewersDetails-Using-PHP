<?php
//Stories a user seen and not seen
include('Connections.php');
include('session.php');
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
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
                $Storysql="SELECT * FROM `story` ORDER BY Date DESC";
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
    <script>

        function UpdateTable(UserID,Start,End){
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'OrderUpdate.php?UserID='+UserID+"&Start="+Start+"&End="+End, true);
            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 300) {
                    document.getElementById('Output').innerHTML=xhr.responseText
                } else {
                    console.error('Error:', xhr.statusText);
                }
            };

            xhr.onerror = function() {
                console.error('Network Error');
            };
            xhr.send();
        }
        


        function drag_start(event,object_s) {
            if(object_s==0){
                row = event.target.closest('tr');
            }else{
                row = event.target
            }
            startIndex = Array.from(row.parentNode.children).indexOf(row)+1;
        }

        function drag_over(event,object_s) {
            event.preventDefault();
            event.dataTransfer.dropEffect = 'move';
            if(object_s==0){
                var target = event.target.closest('tr');
            }else{
                var target = event.target
            }
            if (target && target !== row) {
                var children = Array.from(target.parentNode.children);
                if (children.indexOf(target) > children.indexOf(row)) {
                    target.after(row);
                } else {
                    target.before(row);
                }
            }
        }
        function drag_drop(event,UserID){
            event.preventDefault();
            var endIndex = Array.from(row.parentNode.children).indexOf(row)+1;
            UpdateTable(UserID,startIndex,endIndex)
            setTimeout(Ordervalues, 700);
            // console.log(UserID+"   Start: "+startIndex+"  END: "+endIndex)
        }
        function Ordervalues(){
            tableSI=document.querySelectorAll("#OrderNum");
            i=1;
            tableSI.forEach((element)=>{
                element.innerHTML=i;
                i++;
            })
        }
        Ordervalues();
    </script>
</body>
</html>