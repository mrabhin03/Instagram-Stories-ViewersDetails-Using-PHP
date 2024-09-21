<?php
include('Connections.php');
include('session.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insta Code</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-javascript.min.js"></script>

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
            padding: 10px;
            cursor: pointer;
            font-size:14px;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #2980b9;
        }
        #copies{
            font-size:14px;
        }
        button>b{
            font-weight:100;
        }
        #header-details{
          width:100%; 
          display:flex; 
          align-items:center; 
          justify-content:space-between;
        }
        #header-details a{
          color:white;
        }
    </style>
</head>
<body>
    
    <h1>Insta Code</h1>
    <form  method="post">
        <div id="header-details">
          <button type="button" onclick="copyText()"><ion-icon id="copies" name="copy-outline"></ion-icon> <b id="Copied">Copy</b> </button>
          <a href="Instructions.php">How it works?</a>
        </div>
        <pre ondblclick="copyText()"><code   class="language-javascript" id="inputBox" ></code></pre>        
    </form>
    <script>
        const copies = document.getElementById("copies");
        const Copied=document.getElementById("Copied");
        function copyText() {
            navigator.clipboard.writeText(code[0]);
            copies.name="checkmark-outline";
            Copied.innerHTML="Copied!"
            setTimeout(backToCopy, 2000);
        }
        function backToCopy(){
            copies.name="copy-outline";
            Copied.innerHTML="Copy"
        }


        code=[];
        code.push(`const elements = document.querySelectorAll(".x1dm5mii.x16mil14.xiojian.x1yutycm.x1lliihq.x193iq5w.xh8yej3");
elements[0].parentElement.parentElement.classList.add("MainScroll");
visits = [];
function scrollToBottom(containerSelector) {
  const container = document.querySelector(containerSelector);
  if (!container) {
    console.log("Container not found");
    return;
  }

  if (container.scrollHeight === container.clientHeight) {
    console.log("Container is already at the bottom");
    return;
  }

  function scrollDown() {
    container.scrollBy({ top: 100 });
    const username = Array.from(
      container.querySelectorAll(".x9f619.xjbqb8w.x78zum5.x168nmei.x13lgxp2.x5pf9jr.xo71vjh.x1uhb9sk.x1plvlek.xryxfnj.x1c4vz4f.x2lah0s.x1q0g3np.xqjyukv.x6s0dn4.x1oa3qoh.x1nhvcw1")
    );

    const name = Array.from(
      container.querySelectorAll(".x1lliihq.x1plvlek.xryxfnj.x1n2onr6.x193iq5w.xeuugli.x1fj9vlw.x13faqbe.x1vvkbs.x1s928wv.xhkezso.x1gmr53x.x1cpjm7i.x1fgarty.x1943h6x.x1i0vuye.xvs91rp.xo1l8bm.x1roi4f4.x10wh9bi.x1wdrske.x8viiok.x18hxmgj")
    );
    const usernamesval = username.map((username) =>
      username.textContent.trim()
    );
    const namesval = name.map((name) => name.textContent.trim());
    for (i = 0; i < namesval.length; i++) {
      let UserActualName = namesval[i].replace(/,/g, '');
      UserActualName=UserActualName.replace(/'/g, '');
      if (visits.indexOf(usernamesval[i] + " (" + UserActualName + ")") == -1) {
        visits.push(usernamesval[i] + " (" + UserActualName + ")");
      }
    }

    if (
      container.scrollTop + container.clientHeight >=
      container.scrollHeight
    ) {
      console.log("Users who saw Your Story are: ");
      console.log(visits);
      clearInterval(scrollInterval);
      return;
    }
  }

  const scrollInterval = setInterval(scrollDown, 10);
}

scrollToBottom(".MainScroll");`);
function getCodes(){
  const inputBox = document.getElementById("inputBox").innerHTML=code[0];
}
getCodes();


    </script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>