<?php
include('Connections.php');
include('session.php');
$storyID=$_SESSION['StoryID'];
$sqlstory="SELECT * FROM story WHERE StoryID=$storyID";
$stqu=$conn->query($sqlstory)->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Story Viewers</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php 
    ?>
    <h1>Instagram Story Viewers</h1>
    <h3>Story :<?php echo "'".$stqu['StoryName']."'<br><b style='font-size:16px;'>".$stqu['Date']."</b>";?></h3>
    
    <form id="ViewFormData">
    <div class="Newform">
        <input onkeyup="InputValue(this)" type="text" placeholder="Search">
        <select id="selectMode" onchange="ChangeOption(this)">
            <option value="0">All</option>
            <option value="1">Seen</option>
            <option value="2">Not Seen</option>
            <option value="3">New User</option>
        </select>
    </div>
        <table>
            <thead>
                <th>SI NO</th>
                <th>UserName</th>
                <th>Seens</th>
            </thead>
            <tbody id="TheTableBody">
            </tbody>
        </table>
    </form>
    <script>
        function gettable(Mode,input_value){
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'Tables.php?Mode='+Mode+"&Value="+input_value, true);
            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 300) {
                    document.getElementById('TheTableBody').innerHTML=xhr.responseText
                } else {
                    console.error('Error:', xhr.statusText);
                }
            };

            xhr.onerror = function() {
                console.error('Network Error');
            };
            xhr.send();
        }
        gettable(0,0);

        function ChangeOption(object){
            gettable(object.value,0)
        }
        function InputValue(object){
            if(object.value==''){
                valu=document.getElementById('selectMode').value;
                gettable(valu,0)
            }else{
                gettable(4,object.value)
            }
            
        }
    </script>
</body>
</html>