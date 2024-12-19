<?php
//Updating the view list of a story
include('Connections.php');
include('session.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Stories</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>View Data</h1>
    <form  method="post" class="form1">
        <label for="StoryName">Story Name</label>
        <select name="StoryName" id="">
            <?php
                $storysql="SELECT * FROM story ORDER BY StoryID DESC";
                $storyqw=$conn->query($storysql);
                if($storyqw->num_rows>0){
                    while($datastory=$storyqw->fetch_assoc()){
                        echo "<option value='".$datastory['StoryID']."'>".$datastory['StoryName']."</option>";
                    }
                }else{
                    echo "<option value='' disabled selected>No Stories Avaiable</option>";
                }
            ?>
        </select>
        <label for="data">Story View Data</label>
        <textarea rows="10" name="data" id="data" placeholder="Data like: ['Userame1(Name)','Userame2(Name)']"></textarea>
        <input type="submit" value="Submit" name="Story">
        <!-- <h6>or</h6>
        <a href="viewselected.php">View Created</a> -->
    </form>

    <?php
    if(isset($_POST['Story'])){
        $StoryName=$_POST['StoryName'];
        $max=$StoryName;
        $_SESSION['StoryID']=$StoryName;
        if($_POST['data']!=''){
            $Viewdata = str_replace(['[', ']','"'], '', $_POST['data']);
            $ViewdataAR = explode(',', $Viewdata);
            $ViewdataAR = array_map(function($item) {
                return preg_replace('/^\s+|\s+$/u', '', $item);
            }, $ViewdataAR);
            $dryu=0;
            
            $insertviewa="INSERT INTO `viewers`(`UserID`, `StoryID`) VALUES ";
            foreach($ViewdataAR as $dr ){
                $dr=str_replace("'", '', $dr);
                $check1="SELECT UserID FROM users WHERE UserName='$dr'";
                $chqw=$conn->query($check1);
                if($chqw->num_rows>0){
                    $idva=$chqw->fetch_assoc();
                    $User_id=$idva['UserID'];
                }else{
                    $maxvar=$conn->query("SELECT MAX(Sort) as SortMax FROM users")->fetch_assoc();
                    $sortsval=$maxvar['SortMax']+1;
                    $insertusera="INSERT INTO `users`(`UserName`,`Sort`, `Status`) VALUES ('$dr','$sortsval',0)";
                    $conn->query($insertusera);
                    $check1="SELECT UserID FROM users WHERE UserName='$dr'";
                    $chqw=$conn->query($check1);
                    $idva=$chqw->fetch_assoc();
                    $User_id=$idva['UserID'];
                }
                $check2="SELECT * FROM viewers WHERE UserID='$User_id' AND StoryID='$max'";
                $chqw2=$conn->query($check2);
                if($chqw2->num_rows==0){
                    $dryu++;
                    $insertviewa.="($User_id,$max),";
                }
            
            }
            if($dryu>0){
                $insertviewa=substr($insertviewa, 0, -1);
                $conn->query($insertviewa);
            }
        }

        header("Location: viewwatchs.php");
    }
    ?>
</body>
</html>