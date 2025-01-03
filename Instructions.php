<?php
include('CommonFiles/Connections.php');
include('CommonFiles/session.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <title>Instructions</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-javascript.min.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <style>
        body {
          user-select: none;
            font-family: Arial, sans-serif;
            background-color:#232323;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        ::-webkit-scrollbar{
            width: 0px;
        }
        h1 {
            color: white;
        }
        form {
            background-color: #333;
            /* border: 3px solid #aaa; */
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            max-width: 700px;
            width: 100%;
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap:5px;
        }
        .language-javascript{
          user-select: none;
            background-color:red;
            border-radius:20px !important;
            color:#ddd;
            padding: 0px;
            margin: 0px;
            /* border: 3px solid #777; */
            height:420px;
            transition: border-color 0.3s ease;
            display: block;
            margin: 10px 0;
            width: 90%;
            cursor: pointer;

        }
        textarea:focus {
            border-color: #3498db;
            outline: none;
        }
        button {
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 7px;
            cursor: pointer;
            font-size:14px;
            margin-left:26px;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #2980b9;
        }
        #copies{
            font-size:14px;
        }
        
        #header-details{
            color:#ddd;
            width:100%; 
            display:flex; 
            align-items:start; 
            flex-direction:column;
            justify-content:space-between;
            padding:10px;
            background-color:#383838;
            border-radius:6px;
            gap:10px
        }
        #header-details>b{
            margin:10px 0 10px 26px;
            font-weight:100;
            
        }
        #header-details>summary{
            font-size:17px;
            cursor: pointer;
            width: fit-content;
            display:flex;
        }
        #header-details>img{
            height: 200px;
            margin-left:26px ;
            border-radius:6px;
        }
        #headerData{
            max-width: 750px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        #headerData>a{
            color: #5294d5;
            display: grid;
            place-content: center;
        }
    </style>
</head>
<body>
    
    <h1 id='headerData'><a href="index.php"><ion-icon name="arrow-back-outline"></ion-icon></a>Instructions<ion-icon style='opacity:0;' name="arrow-forward-outline"></ion-icon></h1>
    <form  method="post">
        <details id="header-details">
            <summary>Step 1</summary>
            <b>Copy the javascript code given in Code page</b>
            <a href="Code.php"><button type='button'>View Code</button></a>
        </details>
        <details id="header-details">
            <summary>Step 2</summary>
            <b>Open instagram web in your PC</b>
            <a href="https://www.instagram.com/" target="_blank"><button type='button'>Visit Instagram</button></a>
        </details>
        <details id="header-details">
            <summary>Step 3</summary>
            <b>Open story you want the data from and open the views of the story</b>
        </details>
        <details id="header-details">
            <summary>Step 4</summary>
            <b>Press F12 for Inspect (Maybe different Hotkey for other browsers)</b>
            <img src="Images/Inspect.png" alt="">
        </details>
        <details id="header-details">
            <summary>Step 5</summary>
            <b>Open console in the opened Inspect (Only Past this code if and only if you trust this code)</b>
            <img src="Images/Console.png" alt="">
        </details>
        <details id="header-details">
            <summary>Step 6</summary>
            <b>Past the code that copied in to the console. Sometimes you need to type 'past' inorder to past something on the console.</b> 
            <img src="Images/PastCode.png" alt="">
        </details>
        
        <details id="header-details">
            <summary>Step 7</summary>
            <b>Then copy the output u get and past it in Create story page in this web</b>
            <a href="CreateStory.php"><button type='button'>Create story</button></a>
        </details>
                
    </form>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>