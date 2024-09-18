<?php
include('Connections.php');
include('session.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Details</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php 
    ?>
    <h1>Instagram Users</h1>
    <p id="Output"></p>
    <form id="ViewFormData">
        <table>
            <thead>
                <th>SI NO</th>
                <th>UserName</th>
                <th>Viewed</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php
                $userssql="SELECT * FROM users ORDER BY Sort";
                $usersda=$conn->query($userssql);
                if($usersda->num_rows>0){
                    $jur=1;
                    while($userdata=$usersda->fetch_assoc()){
                        $UserName=$userdata['UserName'];
                        $Links = explode('(', $UserName);
                        $Links= $Links[0];
                        ?>
                        <tr draggable="true" ondragstart="drag_start(event,0)" ondragover="drag_over(event,0)" ondragend="drag_drop(event,'<?php echo $userdata['UserID'];?>')">
                        <td id="OrderNum"><?php echo $userdata['Sort']; ?></td>
                        <?php
                            $new=($userdata['Status']==0)?"   <b class='newuser'>(NEW)</b>":"";
                            $count1=$conn->query("SELECT StoryID FROM viewers WHERE UserID='".$userdata['UserID']."'")->num_rows;
                            $count2=$conn->query("SELECT StoryID FROM story")->num_rows;
                            $stylecolor=($count1!=$count2)?"color:red;":"";
                        ?>
                        <td style='text-align:left;padding-right:25px;padding-left:10px;min-width:440px;'><a href='https://www.instagram.com/<?php echo $Links;?>' target='_blank'><?php echo $UserName.$new;?></a></td>
                        <td <?php echo "style='$stylecolor'"?>><?php echo "($count1/$count2)";?></td>
                        <td style='padding:5px 10px 5px 10px;'><a href="UserDetails.php?details=<?php echo $userdata['UserID'];?>" ><button type='button' class="View">View</button></a></td>
                        </tr>
                        <?php
                        $jur++;
                    }
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