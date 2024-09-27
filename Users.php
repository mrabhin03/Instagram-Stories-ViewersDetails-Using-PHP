<?php
//Users details
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
        <div>
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

        function GetDeatils(value){
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'UsersTable.php?Option='+value, true);
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
            GetDeatils(TheValue);
        }
        
        setTimeout(CheckUser, 1);
    </script>
</body>
</html>