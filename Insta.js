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
