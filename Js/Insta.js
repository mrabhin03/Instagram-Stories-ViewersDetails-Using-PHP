//The Javascript code for data from instagram
const elements = document.querySelectorAll(".x1dm5mii.x16mil14.xiojian.x1yutycm.x1lliihq.x193iq5w.xh8yej3");
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
      document.querySelectorAll(".x9f619.xjbqb8w.x78zum5.x168nmei.x13lgxp2.x5pf9jr.xo71vjh.x1uhb9sk.x1plvlek.xryxfnj.x1c4vz4f.x2lah0s.x1q0g3np.xqjyukv.x6s0dn4.x1oa3qoh.x1nhvcw1")
    );

    const name = Array.from(
      document.querySelectorAll(".x1lliihq.x1plvlek.xryxfnj.x1n2onr6.x193iq5w.xeuugli.x1fj9vlw.x13faqbe.x1vvkbs.x1s928wv.xhkezso.x1gmr53x.x1cpjm7i.x1fgarty.x1943h6x.x1i0vuye.xvs91rp.xo1l8bm.x1roi4f4.x10wh9bi.x1wdrske.x8viiok.x18hxmgj")
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

scrollToBottom(".MainScroll");



function CloseFriends() {
  const container = document.querySelector(".x9f619.xjbqb8w.x78zum5.x168nmei.x13lgxp2.x5pf9jr.xo71vjh.x1uhb9sk.xw2csxc.x1odjw0f.x1iyjqo2.x2lwn1j.xeuugli.xdt5ytf.xqjyukv.x1qjc9v5.x1oa3qoh.x1nhvcw1");
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
    if (
      container.scrollTop + container.clientHeight >=
      container.scrollHeight
    ) {
      clearInterval(scrollInterval);
      return;
    }
  }

  const scrollInterval = setInterval(scrollDown, 10);
}
CloseFriends();


function toggleCloseFriend() {
  const checkboxs = document.querySelectorAll('div[aria-label="Toggle checkbox"]');
  console.log(checkboxs.length)
  checkboxs.forEach(element => {
    if (element) {
      element.click();
          console.log("Checkbox toggled!");
      } else {
          console.log("Checkbox not found!");
      }
  });
  // 
}

toggleCloseFriend();



function CloseFriendsData(Option) {
  

  const Users = document.querySelectorAll('div[aria-label="Toggle checkbox"] div[style*="mask-image"]');
  const uncheckedUrl = 'https://i.instagram.com/static/images/bloks/icons/generated/circle__outline__24-4x.png/2f71074dce25.png';
  const checkedUrl = 'https://i.instagram.com/static/images/bloks/icons/generated/circle-check__filled__24-4x.png/219f67ac4c95.png';
  usersForUpdate=[];
  Users.forEach(User => {
    if (User) {

      Namesobj=User.parentElement.parentElement.parentElement.parentElement;
      Username=Namesobj.querySelector('span[data-bloks-name="bk.components.Text"]').textContent;
        const maskImageUrl = User.style.maskImage;
        Message=Username;
        if (maskImageUrl.includes(uncheckedUrl)) {
          temp=" wasn't a Close Friend";
          if(Option){
            usersForUpdate.push(User.closest('div[aria-label="Toggle checkbox"]'));
            temp=" Added to Close Friend";

            // console.log("Checkbox was unchecked, now selected!");
          }
            
        } else if (maskImageUrl.includes(checkedUrl)) {
          temp=" Already a Close Friend";
          if(!Option){

            usersForUpdate.push(User.closest('div[aria-label="Toggle checkbox"]'));
            temp=" Removed from Close Friend";

             // console.log("Checkbox is already selected, now removed");
            
          }
          
           
        }
        Message+=temp;
        console.log(Message)
    } else {
        console.log("Checkbox not found!");
    }
  });
    const container = document.querySelector(".x9f619.xjbqb8w.x78zum5.x168nmei.x13lgxp2.x5pf9jr.xo71vjh.x1uhb9sk.xw2csxc.x1odjw0f.x1iyjqo2.x2lwn1j.xeuugli.xdt5ytf.xqjyukv.x1qjc9v5.x1oa3qoh.x1nhvcw1");
    if (!container) {
      console.log("Container not found");
      return;
    }

    if (container.scrollHeight === container.clientHeight) {
      console.log("Container is already at the bottom");
      return;
    }
    io=0

    function scrollDown(Users,usersForUpdate,Option) {
     
      if(io<Users.length){
        if(Option){
          Users[io].style.maskImage = 'url("https://i.instagram.com/static/images/bloks/icons/generated/circle-check__filled__24-4x.png/219f67ac4c95.png")';
          Users[io].style.backgroundColor="rgb(0,149,246)";
        }else{
          Users[io].style.maskImage = 'url("https://i.instagram.com/static/images/bloks/icons/generated/circle__outline__24-4x.png/2f71074dce25.png")';
          Users[io].style.backgroundColor="rgb(54,54,54)";
        }
      io++
      }
      container.scrollBy({ top: 45 });
      if (
        container.scrollTop + container.clientHeight >=
        container.scrollHeight-100
      ) {
        clearInterval(scrollInterval);
        
        setTimeout(()=>{
          usersForUpdate.forEach((object)=>{
            object.click();
          });
        },1000)
        return;
      }
    }

    const scrollInterval = setInterval(()=>{scrollDown(Users,usersForUpdate,Option)}, 10);
}


CloseFriendsData(true);

