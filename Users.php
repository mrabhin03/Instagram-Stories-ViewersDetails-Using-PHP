<?php
//Users details
include('Connections.php');
include('session.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users Details</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time();?>">
</head>
<body>
<?php 
    ?>
    <h1>Instagram Users</h1>
    <p id="Output"></p>
    <form id="ViewFormData">
        <div>
            <div style='display:flex;gap:20px;align-items:center;'>
                <button class='View' type='button' onclick='dateChange(this,0)'>All Time</button>
                or
                <input type="month" onchange='dateChange(this,1)' id=""  style='width:200px;height:100%;margin:0;'>
            </div>
            <select id="TheFriendsType" onchange="CheckUser()">
                <option value="0">All</option>
                <option value="1">True Friends</option>
                <option value="2">Fake Friends</option>
            </select>
        </div>
        <table>
            <thead>
                <th>SI NO</th>
                <th>UserName</th>
                <th>Viewed</th>
                <th>Action</th>
            </thead>
            <tbody id="TheUsersDetails">
                
            </tbody>
        </table> 
    </form>
    <script>
        var TheValue;
        var Date='';
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

        function GetDeatils(){
            value=TheValue
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'UsersTable.php?Option='+value+'&Date='+Date, true);
            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 300) {
                    document.getElementById('TheUsersDetails').innerHTML=xhr.responseText;
                    Ordervalues();
                } else {
                    console.error('Error:', xhr.statusText);
                }
            };

            xhr.onerror = function() {
                console.error('Network Error');
            };
            xhr.send();
        }

        function dateChange(object,Mode){
            if(Mode==0){
                Date='';
            }else{
                Date=object.value;
            }
            GetDeatils();
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
        function CheckUser(){
            TheValue=document.getElementById("TheFriendsType").value
            GetDeatils();
        }
        
        setTimeout(CheckUser, 1);
    </script>
</body>
</html>