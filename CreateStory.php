<!-- Create New Story details -->
<?php
include('CommonFiles/Connections.php');
include('CommonFiles/session.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Story Add</title>
    <link rel="stylesheet" href="Style/style.css?v=<?php echo time();?>">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>
<body>
    <h1 id='headerData'  style='max-width: 550px;'><a href="index.php"><ion-icon name="arrow-back-outline"></ion-icon></a>Create New Story<ion-icon style='opacity:0;' name="arrow-forward-outline"></ion-icon></h1>
    <form  method="post" class="form1">
        <label for="StoryName">Story Name</label>
        <div class="StoryDetails">
            <input type="text" id="StoryName" name="StoryName" placeholder="Enter Story Name" required>
            <input type="date" value='<?php echo date("Y-m-d");?>'name="StoryDate" required>
        </div>
        <label for="data">Story View Data</label>
        <textarea rows="10" name="data" id="data" placeholder="Data like: ['Userame1(Name)','Userame2(Name)']" required></textarea>
        <input type="submit" value="Submit" name="Story">
    </form>

    <?php
    if(isset($_POST['Story'])){
        $StoryName=$_POST['StoryName'];
        $StoryDate=$_POST['StoryDate'];
        $Storyinsert="INSERT INTO `story`( `StoryName`,`Date`) VALUES ('$StoryName','$StoryDate')";
        $conn->query($Storyinsert);
        $getl="SELECT MAX(StoryID) as ID FROM `story`";
        $maxs=$conn->query($getl)->fetch_assoc();
        $max=$maxs['ID'];
        $_SESSION['StoryID']=$max;
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

        header("Location: viewwatchs.php");
    }
    ?>
</body>
</html>