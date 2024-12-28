<?php
include('CommonFiles/session.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="Style/style.css?v=<?php echo time();?>">
    <title>Insta Viewers</title>
    <meta property="og:image" content="favicon.ico">
    <link rel="manifest" href="manifest.json">
    <link rel="icon" href="favicon.ico" type="image/x-icon" sizes="any">
    <link rel="icon" type="image/png" href="Logo 192x192.png">
</head>
    <body>
        <h1>Instagram Story Management</h1>
        <div class='Home-nav'>
            <a href="CreateStory.php"><button class='button1'>Create new Story</button></a>
            <a href="ViewStories.php"><button class='button1'>Update Story</button></a>
            <a href="StoryManage.php"><button class='button1'>Story Management</button></a>
            <a href="Users.php"><button class='button1'>User Management</button></a>
            <a href="Code.php"><button class='button1'>Details Code</button></a>
            <a href="Instructions.php"><button class='button1'>Instructions</button></a>
            <a href="MergeUser.php"><button class="button1" type='button' >Merge Users</button></a>
        </div>
        <!-- <footer>Don't Forget to import Database</footer> -->
    </body>
</html>



