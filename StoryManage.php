<?php
//View and edit created stories 
include('CommonFiles/Connections.php');
include('CommonFiles/session.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stories Details</title>
    <link rel="stylesheet" href="Style/style.css?v=<?php echo time();?>">
</head>
<body>
<?php 
    ?>
    <h1>Instagram Stories</h1>
    <p id="Output"></p>
    <form id="ViewFormData">
        <table>
            <thead>
                <th>SI NO</th>
                <th>Story Name</th>
                <th>Date</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php
                $userssql="SELECT * FROM story ORDER BY StoryID DESC";
                $usersda=$conn->query($userssql);
                if($usersda->num_rows>0){
                    $jur=1;
                    while($userdata=$usersda->fetch_assoc()){
                        $StoryName=$userdata['StoryName'];
                        ?>
                        <tr>
                        <td><?php echo $jur; ?></td>
                        <td style='text-align:left;padding-right:25px;padding-left:10px;min-width:440px;' id='Stor<?php echo $userdata['StoryID'];?>'><?php echo $StoryName;?></td>
                        <td style='padding-right:25px;padding-left:10px;' id='StorDat<?php echo $userdata['StoryID'];?>'><?php echo $userdata['Date'];?></td>
                        <td style='padding:5px 10px 5px 10px;'>
                            <button type='button' class="View" onclick="StoryControl('<?php echo $userdata['StoryID'];?>',0,0,1)">View</button>
                            <button type='button' class="View" onclick="editdetails('<?php echo $userdata['StoryID'];?>',this)">Edit</button>
                        </td>
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

        function StoryControl(UserID,Message,Date,Mode){
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'SubCodes/SaveStoryEdit.php?Mode='+Mode+'&UserID='+UserID+'&Message='+Message+"&Date="+Date, true);
            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 300) {
                    document.getElementById('Output').innerHTML=xhr.responseText
                    if(Mode==1){
                        window.location='viewwatchs.php';
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
        function editdetails(object,button){
            mainobject=document.getElementById('Stor'+object);
            Datemainobject=document.getElementById('StorDat'+object);
            if(mainobject.classList.contains('Edits')){
                inputvalue=document.getElementById('In'+object).value;
                Dateinputvalue=document.getElementById('InDa'+object).value;
                if(inputvalue!=''){
                    button.innerHTML='Edit';
                    mainobject.classList.remove('Edits');
                    mainobject.innerHTML=inputvalue;
                    Datemainobject.innerHTML=Dateinputvalue;
                    StoryControl(object,inputvalue,Dateinputvalue,0)
                }
            }else{
                button.innerHTML='Save';
                mainobject.classList.add('Edits');
                Dainnervalue=Datemainobject.innerHTML;
                innervalue=mainobject.innerHTML;
                mainobject.innerHTML=`<input type='text' value='${innervalue}' id='In${object}'>`
                Datemainobject.innerHTML=`<input type='date' value='${Dainnervalue}' id='InDa${object}'>`
            }
        }
    </script>
</body>
</html>