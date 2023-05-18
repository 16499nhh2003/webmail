var accountButton = document.getElementById("account");
var accountForm = document.getElementById("Account-form");
var close = document.getElementById("closeFormAcc");
accountButton.addEventListener("click", function () {
  accountForm.style.display = "block";
});
close.addEventListener("click", function () {
  accountForm.style.display = "none";
});

function logOut() {
  window.location.href = "./login.php";
  document.getElementById("Account-form").submit();
}

var trashButtons = document.querySelectorAll(".btn-trash");
trashButtons.forEach(function (trashButton) {
  trashButton.addEventListener("click", function () {
    var emailRow = this.closest(".emailRow");
    emailRow.remove();
  });
});

const openFormBtn = document.getElementById("openForm");
const closeFormBtn = document.getElementById("closeForm");
const myForm = document.getElementById("myForm");
openFormBtn.addEventListener("click", function () {
  myForm.style.display = "block";
});
closeFormBtn.addEventListener("click", function () {
  myForm.style.display = "none";
});
//ngan khong cho submit

$("#myForm").keydown(function (event) {
  if (event.keyCode == 13) {
    event.preventDefault();
  }
});

const btnSubmit = document.getElementById("btn-send");
//find username by email


//send mail
let form1 = document.getElementById("formSentMail");
form1.addEventListener("submit", (evt) => {
    evt.preventDefault();
    if (document.getElementById("cc").value !== "" && document.getElementById("to").value !== "") {
        let to = document.getElementById("to").value;
        let cc = document.getElementById("cc").value;
        let errorFlag = false;
        //let bcc = document.getElementById("bcc").value;
        let nguoigui = to;
        nguoigui += ',' + cc;
        let nguoinhan = [...new Set(nguoigui.split(',').map(str => str.trim()))];
        document.getElementById("cc").value = nguoinhan.filter(item => item !== to);
        for (let i = 0; i < nguoinhan.length; i++) {
          let recipient = nguoinhan[i].trim();
            let infoSent = {
                chude: document.getElementById("subject").value,
                noidung: document.getElementById("content").value,
                nguoigui: recipient,
                thoigian: formatDate(Date.now()),
                starred: 0,
                read: 1,
                idFolder: 2,
                username: $("#messName").text().trim(),
            };
            console.log(infoSent)
            fetch("./api/sendReceiveMail.php", {
                method: "post",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(infoSent),
            })
            .then(res => res.json())
            fetch('./api/findMailByUser.php',{
                method: 'post',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({username:$("#messName").text().trim()})}
            )
            .then(res => res.json())
            .then(json =>{
                if(json.success === true){
                    let  nguoigui1 = json.data;
                    fetch('./api/findUserNameByEmail.php',{
                    method: 'post',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({email:recipient})}
                    )
                    .then(res => res.json())
                    .then(json =>{if (json.success === true){
                    let infoReceive = {
                        chude   :document.getElementById("subject").value,
                        noidung :document.getElementById("content").value,
                        nguoigui:  nguoigui1,
                        thoigian:formatDate(Date.now()),
                        starred : 0,
                        read    : 0,
                        idFolder : 1,
                        username:json.data,
                        }
                        fetch('./api/sendReceiveMail.php',{
                        method: 'post',
                        headers: {'Content-Type': 'application/json'},
                        body: JSON.stringify(infoReceive)}
                        )
                        .then(res =>res.json())
                        .then(json => {
                        if(json.code !== 0){
                            errorFlag = true;
                        }
                        })
                    }})
                }
            })
        }
        if (errorFlag) {
          alert("Thông báo có lỗi xảy ra");
        } else {
          alert("Gửi email thành công");
        }
    }
    else{
        let infoSent = {
            chude   :document.getElementById("subject").value,
            noidung :document.getElementById("content").value,
            nguoigui:document.getElementById("to").value,
            thoigian:formatDate(Date.now()),
            starred : 0,
            read    : 1,
            idFolder : 2,
            username:$("#messName").text().trim(),
        }
        console.log(infoSent)
        fetch('./api/sendReceiveMail.php',{
            method: 'post',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(infoSent)}
        )
        .then(res => res.json())
        fetch('./api/findMailByUser.php',{
            method: 'post',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({username:$("#messName").text().trim()})}
        )
        .then(res => res.json())
        .then(json =>{
            if(json.success === true){
            let  nguoigui1 = json.data;
            fetch('./api/findUserNameByEmail.php',{
                method: 'post',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({email:document.getElementById("to").value})}
                )
            .then(res => res.json())
            .then(json =>{if (json.success === true){
                let infoReceive = {
                chude   :document.getElementById("subject").value,
                noidung :document.getElementById("content").value,
                nguoigui:  nguoigui1,
                thoigian:formatDate(Date.now()),
                starred : 0,
                read    : 0,
                idFolder : 1,
                username:json.data,
                }
                fetch('./api/sendReceiveMail.php',{
                    method: 'post',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify(infoReceive)}
                )
                .then(res =>res.json())
                .then(json => {
                    if(json.code === 0){
                    alert("Gửi email thành công");
                    $('#to').val("");
                    $('#subject').val("");
                    $('#content').val("");
                    }
                    else{
                      alert("Thông báo có lỗi xảy ra");
                    }
                })
            }})
            }
        })
    }
  });

function formatDate(date) {
  var d = new Date(date),
    month = "" + (d.getMonth() + 1),
    day = "" + d.getDate(),
    year = d.getFullYear();

  if (month.length < 2) month = "0" + month;
  if (day.length < 2) day = "0" + day;
  return [year, month, day].join("-");
}
var emailDiv = document.getElementById("email");
let username = $("#messName").text().trim();
let start = $("#start").text.trim();

var inboxButton = document.getElementById("openInbox");
var inboxDiv = document.getElementById("inbox");
inboxButton.addEventListener("click", function () {
  inboxDiv.style.display = "block";
  sentDiv.style.display = "none";
  document.getElementById("email").style.display = "none";
  // readDiv.style.display = "none";
  // unreadDiv.style.display = "none";
  importantDiv.style.display = "none";
  trashDiv.style.display = "none";
  fetch(`./api/get-Mail-UsernameType.php?username=${username}&&idFolder=1`)
    .then((res) => res.json())
    .then((json) => {
        if(json.success ===  true){
            showDiv(json.data);
            let idArray = [];
            for (let i = 0; i < json.data.length; i++) {
              idArray.push(json.data[i].id);
            }
            const forwardBtns = document.querySelectorAll('[id^="forward"]');
            forwardBtns.forEach((btn) => {
                btn.addEventListener('click', () => {
                    const index = btn.getAttribute('id').split('forward')[1];
                    let object = json.data.find((item) => item.id === idArray[index]);
                    myForm.style.display = "block";
                    document.getElementById("subject").value = object['chude'];
                    document.getElementById("content").value = object['noidung'];
                });
            });

            const emailRowId = document.querySelectorAll('[id^="ms"]');
            emailRowId.forEach((ms) => {
                ms.addEventListener('click', () => {
                    const index = ms.getAttribute('id').split('ms')[1];
                    let object = json.data.find((item) => item.id === idArray[index]);
                    document.getElementById("email").style.display = "block";
                    myForm.style.display = "none";
                    importantDiv.style.display = "none";
                    trashDiv.style.display = "none";
                    inboxDiv.style.display = "none";
                    sentDiv.style.display = "none";
                    document.getElementById("from").textContent = "From: "+object["nguoigui"];
                    document.getElementById("emailto").textContent = "To: "+document.getElementById("accountInfo").textContent;
                    document.getElementById("header").textContent = object["chude"];
                    document.getElementById("detailContent").textContent = object["noidung"];
                });
            });

            let email = [];
            email = json.data;
            const findButton = document.getElementById("findUser");
            const infor = document.getElementById("findContent");
            findButton.addEventListener("click", function() {
                let content = infor.value;    
                let search = email.filter((value) => {
                    return value.noidung.toUpperCase().includes(content.toUpperCase());
                });
                console.log(search);   
                showDiv(search);
            });
            
        }
    });
});

const replyButton = document.querySelector("#replyInDetail");
replyButton.addEventListener("click", () => {
    myForm.style.display = "block";
    document.getElementById("to").value = document.getElementById("from").textContent.substring(6);
    document.getElementById("subject").value = document.getElementById("header").textContent;
    document.getElementById("content").value = "Reply: "+document.getElementById("detailContent").textContent+"\n";
});

const forwardButton = document.querySelector("#forwardInDetail");
forwardButton.addEventListener("click", () => {
    myForm.style.display = "block";
    document.getElementById("to").value = "";
    document.getElementById("subject").value = document.getElementById("header").textContent;
    document.getElementById("content").value = document.getElementById("detailContent").textContent;
});

var sentButton = document.getElementById("openSent");
var sentDiv = document.getElementById("sent");
sentButton.addEventListener("click", function () {
  // readDiv.style.display = "none";
  // unreadDiv.style.display = "none";
  document.getElementById("email").style.display = "none";
  importantDiv.style.display = "none";
  trashDiv.style.display = "none";
  inboxDiv.style.display = "none";
  sentDiv.style.display = "block";
  fetch(`./api/get-Mail-UsernameType.php?username=${username}&&idFolder=2`)
    .then((res) => res.json())
    .then((json) => {
      if (json.success === true) {
        showDivSent(json.data);
        let idArray = [];
            for (let i = 0; i < json.data.length; i++) {
              idArray.push(json.data[i].id);
            }
            const forwardBtns = document.querySelectorAll('[id^="forward"]');
            forwardBtns.forEach((btn) => {
                btn.addEventListener('click', () => {
                    const index = btn.getAttribute('id').split('forward')[1];
                    let object = json.data.find((item) => item.id === idArray[index]);
                    myForm.style.display = "block";
                    document.getElementById("subject").value = object['chude'];
                    document.getElementById("content").value = object['noidung'];
                });
            });

            const emailRowId = document.querySelectorAll('[id^="ms"]');
            emailRowId.forEach((ms) => {
                ms.addEventListener('click', () => {
                    const index = ms.getAttribute('id').split('ms')[1];
                    let object = json.data.find((item) => item.id === idArray[index]);
                    document.getElementById("email").style.display = "block";
                    myForm.style.display = "none";
                    importantDiv.style.display = "none";
                    trashDiv.style.display = "none";
                    inboxDiv.style.display = "none";
                    sentDiv.style.display = "none";
                    document.getElementById("from").textContent = "From: "+object["nguoigui"];
                    document.getElementById("emailto").textContent = "To: "+document.getElementById("accountInfo").textContent;
                    document.getElementById("header").textContent = object["chude"];
                    document.getElementById("detailContent").textContent = object["noidung"];
                });
            });

            let email = [];
            email = json.data;
            const findButton = document.getElementById("findUser");
            const infor = document.getElementById("findContent");
            findButton.addEventListener("click", function() {
            let content = infor.value;    
            let search = email.filter((value) => {
                return value.noidung.toUpperCase().includes(content.toUpperCase());
            }); 
            showDivSent(search);
            });
        }
    });
});

var importantButton = document.getElementById("openImportant");
var importantDiv = document.getElementById("important");
importantButton.addEventListener("click", function () {
  trashDiv.style.display = "none";
  inboxDiv.style.display = "none";
  sentDiv.style.display = "none";
  // readDiv.style.display = "none";
  // unreadDiv.style.display = "none";
  importantDiv.style.display = "block";
  document.getElementById("email").style.display = "none";
  fetch(`./api/get-important.php?username=${username}`)
  .then((res) => res.json())
  .then((json) => {
    // console.log(json.data);
    if (json.success === true) {
      showDivImportant(json.data);
      let idArray = [];
            for (let i = 0; i < json.data.length; i++) {
              idArray.push(json.data[i].id);
            }
            const forwardBtns = document.querySelectorAll('[id^="forward"]');
            forwardBtns.forEach((btn) => {
                btn.addEventListener('click', () => {
                    const index = btn.getAttribute('id').split('forward')[1];
                    let object = json.data.find((item) => item.id === idArray[index]);
                    myForm.style.display = "block";
                    document.getElementById("subject").value = object['chude'];
                    document.getElementById("content").value = object['noidung'];
                });
            });

            const emailRowId = document.querySelectorAll('[id^="ms"]');
            emailRowId.forEach((ms) => {
                ms.addEventListener('click', () => {
                    const index = ms.getAttribute('id').split('ms')[1];
                    let object = json.data.find((item) => item.id === idArray[index]);
                    document.getElementById("email").style.display = "block";
                    myForm.style.display = "none";
                    importantDiv.style.display = "none";
                    trashDiv.style.display = "none";
                    inboxDiv.style.display = "none";
                    sentDiv.style.display = "none";
                    document.getElementById("from").textContent = "From: "+object["nguoigui"];
                    document.getElementById("emailto").textContent = "To: "+document.getElementById("accountInfo").textContent;
                    document.getElementById("header").textContent = object["chude"];
                    document.getElementById("detailContent").textContent = object["noidung"];
                });
            });

            let email = [];
            email = json.data;
            const findButton = document.getElementById("findUser");
            const infor = document.getElementById("findContent");
            findButton.addEventListener("click", function() {
            let content = infor.value;    
            let search = email.filter((value) => {
                return value.noidung.toUpperCase().includes(content.toUpperCase());
            }); 
            showDivImportant(search);
            });
        }
  });
});

var trashButton = document.getElementById("openTrash");
var trashDiv = document.getElementById("trash");
trashButton.addEventListener("click", function () {
  inboxDiv.style.display = "none";
  sentDiv.style.display = "none";
  // readDiv.style.display = "none";
  // unreadDiv.style.display = "none";
  importantDiv.style.display = "none";
  trashDiv.style.display = "block";
  document.getElementById("email").style.display = "none";
  fetch(`./api/get-Mail-UsernameType.php?username=${username}&&idFolder=3`)
  .then((res) => res.json())
  .then((json) => {
    if (json.success === true) {
      showDivTrash(json.data);
      let idArray = [];
            for (let i = 0; i < json.data.length; i++) {
              idArray.push(json.data[i].id);
            }
            const forwardBtns = document.querySelectorAll('[id^="forward"]');
            forwardBtns.forEach((btn) => {
                btn.addEventListener('click', () => {
                    const index = btn.getAttribute('id').split('forward')[1];
                    let object = json.data.find((item) => item.id === idArray[index]);
                    myForm.style.display = "block";
                    document.getElementById("subject").value = object['chude'];
                    document.getElementById("content").value = object['noidung'];
                });
            });

            const emailRowId = document.querySelectorAll('[id^="ms"]');
            emailRowId.forEach((ms) => {
                ms.addEventListener('click', () => {
                    const index = ms.getAttribute('id').split('ms')[1];
                    let object = json.data.find((item) => item.id === idArray[index]);
                    document.getElementById("email").style.display = "block";
                    myForm.style.display = "none";
                    importantDiv.style.display = "none";
                    trashDiv.style.display = "none";
                    inboxDiv.style.display = "none";
                    sentDiv.style.display = "none";
                    document.getElementById("from").textContent = "From: "+object["nguoigui"];
                    document.getElementById("emailto").textContent = "To: "+document.getElementById("accountInfo").textContent;
                    document.getElementById("header").textContent = object["chude"];
                    document.getElementById("detailContent").textContent = object["noidung"];
                });
            });

            let email = [];
            email = json.data;
            const findButton = document.getElementById("findUser");
            const infor = document.getElementById("findContent");
            findButton.addEventListener("click", function() {
            let content = infor.value;    
            let search = email.filter((value) => {
                return value.noidung.toUpperCase().includes(content.toUpperCase());
            }); 
            showDivTrash(search);
            });
        }
  });

});

function showDiv(mail) {
  let divss = $("#rowInbox");
  divss.find("div").remove();
  let divs = "";
  for (let i = 0; i < mail.length; i++) {
    let stringTitle = "";
    if (mail[i].read === 0) {
      stringTitle = `<strong>${mail[i].chude}</strong>`;
    } else {
      stringTitle = mail[i].chude;
    }
    let starred ="";
    if(mail[i].starred === 1){
      starred = `<label class="starblack-checkbox">
                  <input type="checkbox"  id="${mail[i].id}"  onclick="changeStarred(this)" >
                  <span class="starblack"></span>
                  </label>`;
    }
    else{
      starred = `<label class="star-checkbox">
                  <input type="checkbox"  id="${mail[i].id}"  onclick="changeStarred(this)" >
                  <span class="star"></span>
                  </label>`;
    }
    divs += `
    <div class="emailRow" id=${mail[i].id}>
      <div class="emailRow__options">${starred}</div>
      <div class="emailRow__title" id="user"><strong>${mail[i].nguoigui}</strong></div>
      <div class="emailRow__message" id="ms${i}" onclick="markRead(${mail[i].id})">
          <div id="">
              ${stringTitle}<span>-</span> ${mail[i].noidung.substring(0, 100)}
          </div>
      </div>
      <div class="date" id="">${mail[i].thoigian}</div>
      <button class="btn-unread">
          <span class="material-symbols-outlined" id="forward${i}">forward</span>
      </button>
      <button class="btn-unread" id="email-${mail[i].id}" odnclick="changeRead(${mail[i].id})">
          <span class="material-symbols-outlined">mark_email_unread</span>
      </button>
      <button class="btn-trash">
        <span id="${mail[i].id}" class="material-symbols-outlined" onclick=delete_change(this)>delete</span>
      </button>
    </div>
    `;
  }
  // divs += `<p>abc</p>`
  divss.append(divs);
}

function showDivImportant(mail) {
  let divss = $("#rowImportant");
  divss.find("div").remove();
  let divs = "";
  for (let i = 0; i < mail.length; i++) {
    let stringTitle = "";
    if (mail[i].read === 0) {
      stringTitle = `<strong>${mail[i].chude}</strong>`;
    } else {
      stringTitle = mail[i].chude;
    }
    let starred ="";
    if(mail[i].starred === 1){
      starred = `<label class="starblack-checkbox">
                  <input type="checkbox"  id="${mail[i].id}"  onclick="changeStarred(this)" >
                  <span class="starblack"></span>
                  </label>`;
    }
    else{
      starred = `<label class="star-checkbox">
                  <input type="checkbox"  id="${mail[i].id}"  onclick="changeStarred(this)" >
                  <span class="star"></span>
                  </label>`;
    }
    divs += `
    <div class="emailRow" id=${mail[i].id}>
      <div class="emailRow__options">${starred}</div>
      <div class="emailRow__title" id="user"><strong>${mail[i].nguoigui}</strong></div>
      <div class="emailRow__message" id="ms${i}" onclick="markRead(${mail[i].id})">
          <div id="">
              ${stringTitle}<span>-</span> ${mail[i].noidung.substring(0, 100)}
          </div>
      </div>
      <div class="date" id="">${mail[i].thoigian}</div>
      <button class="btn-unread">
          <span class="material-symbols-outlined" id="forward${i}">forward</span>
      </button>
      <button class="btn-unread" id="email-${mail[i].id}" onclick="changeRead(${mail[i].id})">
          <span class="material-symbols-outlined">mark_email_unread</span>
      </button>
      <button class="btn-trash">
        <span id="${mail[i].id}" class="material-symbols-outlined" onclick=delete_change(this)>delete</span>
      </button>
    </div>
    `;
  }
  divss.append(divs);
}

function showDivSent(mail) {
  let divss = $("#rowSent");
  divss.find("div").remove();
  let divs = "";
  for (let i = 0; i < mail.length; i++) {
    let stringTitle = "";
    if (mail[i].read === 0) {
      stringTitle = `<strong>${mail[i].chude}</strong>`;
    } else {
      stringTitle = mail[i].chude;
    }
    let starred ="";
    if(mail[i].starred === 1){
      starred = `<label class="starblack-checkbox">
                  <input type="checkbox"  id="${mail[i].id}"  onclick="changeStarred(this)" >
                  <span class="starblack"></span>
                  </label>`;
    }
    else{
      starred = `<label class="star-checkbox">
                  <input type="checkbox"  id="${mail[i].id}"  onclick="changeStarred(this)" >
                  <span class="star"></span>
                  </label>`;
    }
    divs += `
    <div class="emailRow" id=${mail[i].id}>
      <div class="emailRow__options">${starred}</div>
      <div class="emailRow__title" id="user"><strong>${mail[i].nguoigui}</strong></div>
      <div class="emailRow__message" id="ms${i}" onclick="markRead(${mail[i].id})">
          <div id="">
              ${stringTitle}<span>-</span> ${mail[i].noidung.substring(0, 100)}
          </div>
      </div>
      <div class="date" id="">${mail[i].thoigian}</div>
      <button class="btn-unread">
          <span class="material-symbols-outlined" id="forward${i}">forward</span>
      </button>
      <button class="btn-unread" id="email-${mail[i].id}" onclick="changeRead(${mail[i].id})">
          <span class="material-symbols-outlined">mark_email_unread</span>
      </button>
      <button class="btn-trash">
        <span id="${mail[i].id}" class="material-symbols-outlined" onclick=delete_change(this)>delete</span>
      </button>
    </div>
    `;
  }
  divss.append(divs);
}
function showDivTrash(mail) {
  let divss = $("#rowTrash");
  divss.find("div").remove();
  let divs = "";
  for (let i = 0; i < mail.length; i++) {
    let stringTitle = "";
    if (mail[i].read === 0) {
      stringTitle = `<strong>${mail[i].chude}</strong>`;
    } else {
      stringTitle = mail[i].chude;
    }
    divs += `
    <div class="emailRow" id=${mail[i].id}>
      <div class="emailRow__options">
          <label class="star-checkbox">
              <input type="checkbox"  id="${mail[i].id}"  onclick="changeStarred(this)" >
              <span class="star"></span>
          </label>
      </div>
      <div class="emailRow__title" id="user"><strong>${
        mail[i].nguoigui
      }</strong></div>
      <div class="emailRow__message" id="ms${i}" onclick="markRead(${mail[i].id})">
          <div id="">
              ${stringTitle}<span>-</span> ${mail[i].noidung.substring(0, 100)}
          </div>
      </div>
      <div class="date" id="">${mail[i].thoigian}</div>
      <button class="btn-unread">
            <span class="material-symbols-outlined" id="forward${i}">forward</span>
      </button>
      <button class="btn-unread" id="email-${mail[i].id}" onclick="changeRead(${mail[i].id})">
          <span class="material-symbols-outlined">mark_email_unread</span>
      </button>
      <button class="btn-trash">
        <span id="${mail[i].id}" class="material-symbols-outlined" onclick=deleteAll(this)>delete</span>
      </button>
    </div>
    `;
  } 
  divss.append(divs);
}

// move trash
function delete_change(evt) {
  // let id = evt.id;
  fetch("./api/move-mail.php", {
    method: "put",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ id: evt.id }),
  })
    .then((res) => res.json())
    .then((json) => {
      if (json.code === 0) {
        alert("Đã chuyển mail vào thùng rác thành công");
        fetch(
          `./api/get-Mail-UsernameType.php?username=${username}&&idFolder=1`
        )
          .then((res) => res.json())
          .then((json) => {
            if (json.success === true) {
              showDiv(json.data);
              fetch(
                `./api/get-Mail-UsernameType.php?username=${username}&&idFolder=2`
              )
                .then((res) => res.json())
                .then((json) => {
                  if (json.success === true) {
                    showDivSent(json.data);
                  }
                });
            }
          });
      }
    });
}

//delete mail 
function deleteAll(evt) {
  fetch("./api/delete-mail.php", {
    method: "delete",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ id: evt.id }),
  })
  .then((res) => res.json())
  .then((json) => {
      if (json.code === 0) {
          alert("Đã xóa mail thành công");
          fetch(
            `./api/get-Mail-UsernameType.php?username=${username}&&idFolder=3`
          ).then((res) => res.json())
          .then((json) => {
            if (json.success === true) {
              showDivTrash(json.data);
            }
          });
      }
    })
}

function changeStarred(evt){
  fetch("./api/update-starred.php", {
    method: "put",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ id: evt.id }),
  })
  .then((res) => res.json())
  .then((json) => {
      if (json.code === 1) {
          alert("Thay đổi thành công");
      }
    })
}

function changeRead(id){
    fetch("./api/update-read.php", {
        method: "put",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ id: id }),
    })
    .then((res) => res.json())
    .then((json) => {
        if (json.code === 1) {
            alert("Thay đổi thành công");
        }
    })
}

function markRead(id){
    fetch("./api/read.php", {
        method: "put",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ id: id }),
    })
    .then((res) => res.json())
    .then((json) => {
    })
}

// let email = [];
// fetch(`./api/get-Mail-UsernameType.php?username=${username}&&idFolder=1`)
// .then((res) => res.json())
// .then((json) => {
//     if (json.success === true) {
//         console.log(json.data);
//         email = json.data;
//     }
// });
// const findButton = document.getElementById("findUser");
// const infor = document.getElementById("findContent");
// findButton.addEventListener("click", function() {
//     let content = infor.value;    
//     let search = email.filter((value) => {
//         return value.noidung.toUpperCase().includes(content.toUpperCase());
//     });
//     console.log(search);   
//     showDiv(search);
// });