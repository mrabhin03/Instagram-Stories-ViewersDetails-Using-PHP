<?php
//Details of user who seen and not seen your story
include('Connections.php');
include('session.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merge</title>
    <link rel="stylesheet" href="style.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>
<body>
<div id='scriptData'></div>
    <h1>Merge Users</h1>
    <div style='display:flex;gap:20px'>
        <form id="ViewFormData">
        <div class="Newform">
            <input onkeyup="InputValue1(this)" id='Input1' type="text" placeholder="UserName">
        </div>
            <table>
                <thead>
                    <th>SI NO</th>
                    <th>UserName</th>
                    <th>Seens</th>
                </thead>
                <tbody id="TheTableBody1">
                </tbody>
            </table>
        </form>
        <button onclick='MegreUser()' style='height:fit-content; display:flex;align-item:center;gap:5px;font-size:14px;margin-top:30px'class="View">Merge<ion-icon name="arrow-forward-outline"></ion-icon></button>
        <form id="ViewFormData">
        <div class="Newform">
            <input onkeyup="InputValue2(this)" id='Input2' type="text" placeholder="UserName">
        </div>
            <table>
                <thead>
                    <th>SI NO</th>
                    <th>UserName</th>
                    <th>Seens</th>
                </thead>
                <tbody id="TheTableBody2">
                </tbody>
            </table>
        </form>
    </div>
    
    <script>
        function gettable(input_value,Mode){
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'MergeUserData.php?Value='+input_value+'&Mode='+Mode, true);
            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 300) {
                    if(Mode==1){
                        document.getElementById('TheTableBody1').innerHTML=xhr.responseText
                    }else{
                        document.getElementById('TheTableBody2').innerHTML=xhr.responseText
                    }
                } else {
                    console.error('Error:', xhr.statusText);
                }
            };

            xhr.onerror = function() {
                console.error('Network Error');
            };
            xhr.send();
        }
        gettable('',1);
        gettable('',2);
        function InputValue1(object){
            if(object.value==''){
                gettable('',1)
            }else{
                gettable(object.value,1)
            }
            
        }
        function InputValue2(object){
            if(object.value==''){
                gettable('',2)
            }else{
                gettable(object.value,2)
            }
            
        }
        function SelectUser(object,Mode){
            if(Mode==1){
                document.getElementById('Input1').value=object.value
            }else{
                document.getElementById('Input2').value=object.value
            }
        }
        function MegreUser(){
            Value1=document.getElementById('Input1').value;
            Value2=document.getElementById('Input2').value;
            if(Value1==''||Value2==''){
                alert('Select Users');
                return
            }
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'MergeUserCode.php?Value1='+Value1+'&Value2='+Value2, true);
            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 300) {
                    document.getElementById('scriptData').innerHTML=xhr.responseText
                } else {
                    console.error('Error:', xhr.statusText);
                }
            };

            xhr.onerror = function() {
                console.error('Network Error');
            };
            xhr.send();

        }
    </script>
</body>
</html>