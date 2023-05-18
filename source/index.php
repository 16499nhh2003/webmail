<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("Location:login.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="./Source/css/index.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="header">
                <div class="imgTDTU">
                    <img src="./Source/img/TDTU.png" class="TDTU_img">
                </div>
                <div class="appear"><?php
                                    if (isset($_SESSION['name']) && !empty($_SESSION['name'])) {
                                        echo  'Xin chào ' . $_SESSION['name'];
                                    }
                                    ?></div>
                <div id="messName" style="display:none;" class="appear">
                    <?php
                    if (isset($_SESSION['username'])) {
                        echo $username = $_SESSION['username'];
                    } ?>
                </div>
                <div class="spaceSearch">
                    <button id="findUser" class="btn-circle"><span class="material-symbols-outlined">search</span></button>
                    <input id="findContent" type="text" placeholder="Tìm kiếm">
                </div>
                <div class="account">
                    <button class="btn-circle2" id="account">
                        <?php
                        $conn = new mysqli("127.0.0.1", "root", "", "database");
                        $stmt = $conn->prepare("SELECT image from `users` where id = ?");
                        $stmt->bind_param('i', $_SESSION['id']);
                        $stmt->execute();
                        $stmt->bind_result($image);
                        $stmt->fetch();
                        if (isset($image)) {
                            echo  '<img style="width:50px;height:50px;border-radius:100px" src="./photo/' . $image . '">';
                        } else {
                            echo '<span class="material-symbols-outlined">person</span> ';
                        }
                        ?>
                        <!-- <img style="width:50px;height:50px;border-radius:100px" src="./photo/image (1).png"> -->
                        <!-- <span class="material-symbols-outlined">person</span> -->
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div id="sidebar" class="col-2" style="background-color: #F9FADC;height: 88.7vh; white-space: nowrap;">
                <div class="compose_wrapper">
                    <button class="sidebarCompose" id="openForm">
                        <span class="material-symbols-outlined">edit</span>
                        <strong>Soạn thư</strong>
                    </button>
                    <!-- <button class="btn_arrow" id="collapseSideBar"><i class="fa-sharp fa-solid fa-arrow-left"></i></button> -->
                </div>
                <button class="sidebarOption" id="openInbox">

                    <div>
                        <span class="material-symbols-outlined">inbox</span>
                        <strong>&emsp; Hộp thư đến</strong>
                    </div>
                </button>
                <button class="sidebarOption" id="openSent">
                    <div>
                        <span class="material-symbols-outlined">send</span>
                        <strong>&emsp; Hộp thư gửi</strong>
                    </div>
                </button>
                <button class="sidebarOption" id="openImportant">
                    <div>
                        <span class="material-symbols-outlined">star</span>
                        <strong>&emsp;Hộp thư quan trọng</strong>
                    </div>
                </button>
                <button class="sidebarOption" id="openTrash">
                    <div>
                        <span class="material-symbols-outlined">delete</span>
                        <strong>&emsp; Thùng rác</strong>
                    </div>
                </button>
            </div>
            <!-- Inbox component -->
            <div id="inbox" class="col-10 overflow-auto" style="background-color: #F6F8FC;height: 88.7vh;display:none">
                <div class="row">
                    <div id="rowInbox">
                        <div class="emailRow"></div>
                    </div>
                </div>
            </div>
            <!-- Inbox component -->

            <!-- Sent component -->
            <div id="sent" class="col-10 overflow-auto" style="background-color: #F6F8FC;height: 88.7vh; display: none; z-index: 10;">
                <div class="row">
                    <div id="rowSent">
                        <div class="emailRow"></div>
                    </div>
                </div>
            </div>
            <!-- Sent component -->

            <!-- Important component -->
            <div id="important" class="col-10 overflow-auto" style="background-color: #F6F8FC;height: 88.7vh; display: none; z-index:10">
                <div class="row">
                    <div id="rowImportant">
                        <div class="emailRow"></div>
                    </div>
                </div>
            </div>

            <!-- Trash component -->
            <div id="trash" class="col-10 overflow-auto" style="background-color: #F6F8FC;height: 88.7vh; display: none; z-index: 10;">
                <div class="row">
                    <div id="rowTrash">
                        <div class="emailRow"></div>
                    </div>
                </div>
            </div>
            <!-- Trash component -->

            <!-- readEmail -->
            <div id="email" class="col-10" style="background-color: #F6F8FC;height: 88.7vh; display: none; overflow-y: auto; 
                padding: 20px;  flex-direction: column; ">
                <div class="row">
                    <div class="email-header">
                        <p id="from"></p>
                        <p id="emailto"></p>
                        <h3 id="header"></h3>
                    </div>
                    <div class="email-body">
                        <p id="detailContent"></p>
                    </div>
                    <div class="email-footer">
                        <button class="btn-email" style="margin-right: 30px;" id="replyInDetail">Reply</button>
                        <button class="btn-email" id="forwardInDetail">Forward</button>
                    </div>
                </div>
            </div>
            <!-- readEmail -->
        </div>
    </div>
    </div>
    <!-- Form Soạn mail  -->
    <form action="index.php" method="post" id="formSentMail" enctype="multipart/form-data">
        <div id="myForm" class="gmail_compose">
            <div class="header_compose">
                <p style="padding-left: 10px;">Thư mới</p>
                <button style="padding-right: 10px;" type="button" class="Close" id="closeForm">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <div class="body_compose">
                <input type="text" placeholder="To" id="to">
                <input type="text" placeholder="Subject" id="subject">
                <input type="text" placeholder="Cc" id="cc">
                <input type="text" placeholder="Bcc" id="bcc">
                <div class="content">
                    <textarea placeholder="Compose email" id="content"></textarea>
                </div>
            </div>
            <div class="footer_compose">
                <button class="btn-send">Send</button>
                <input style="padding-left: 10px;" type="file" class="attach" id="">
            </div> 
        </div>
    </form>
    <!-- Form Soạn mail  -->
    <!-- Logout form -->
    <form action="" method="post">
        <div id="Account-form" class="Account">
            <div class="header_account">
                <p style="padding-left: 120px;">Tài khoản</p>
                <button style="padding-right: 10px;" type="button" class="Close" id="closeFormAcc">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <div class="body_account">
                <h6><strong><?php echo $_SESSION['name'] ?></strong></h6>
                <p id="accountInfo"><?php echo $_SESSION['email']  ?></p>
            </div>
            <div class="footer_account">
                <a href="upload.php?id=<?php echo $_SESSION['id'] ?>" style="text-decoration:none;margin-right:10px">Xem</a><br>
                <a href="changePassword.php?id=<?php echo $_SESSION['id'] ?>" style="text-decoration:none">Đổi mật khẩu</a><br>
                <a href="Logout.php" style="text-decoration:none">&nbsp Đăng Xuất</a>
            </div>
    </form>
    <!-- Logout form -->
    <!-- script -->
    <!-- <script src="./Source/js/index.js"></script> -->
    <script>
        var accountButton = document.getElementById("account");
        var accountForm = document.getElementById("Account-form");
        var close = document.getElementById("closeFormAcc");
        accountButton.addEventListener("click", function() {
            accountForm.style.display = "block";
        });
        close.addEventListener("click", function() {
            accountForm.style.display = "none";
        });

        function logOut() {
            window.location.href = "./login.php";
            document.getElementById("Account-form").submit();
        }

        var trashButtons = document.querySelectorAll(".btn-trash");
        trashButtons.forEach(function(trashButton) {
            trashButton.addEventListener("click", function() {
                var emailRow = this.closest(".emailRow");
                emailRow.remove();
            });
        });

        const openFormBtn = document.getElementById("openForm");
        const closeFormBtn = document.getElementById("closeForm");
        const myForm = document.getElementById("myForm");
        openFormBtn.addEventListener("click", function() {
            myForm.style.display = "block";
        });
        closeFormBtn.addEventListener("click", function() {
            myForm.style.display = "none";
        });
        //ngan khong cho submit

        $("#myForm").keydown(function(event) {
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
            if (document.getElementById("cc").value !== "") {
                // if (document.getElementById("cc").value !== "" && document.getElementById("to").value !== "") {
                let to = document.getElementById("to").value;
                let cc = document.getElementById("cc").value;
                let mail = document.getElementById("accountInfo").innerHTML;
                let errorFlag = false;
                let nguoigui = to;
                nguoigui += ',' + cc;
                let nguoinhan = [...new Set(nguoigui.split(',').map(str => str.trim()))];
                nguoinhan.shift();
                let receive_cc = mail +"," +nguoinhan.join(",");
                document.getElementById("cc").value = nguoinhan.filter(item => item !== to);
                let infoSent = {
                    chude: document.getElementById("subject").value,
                    noidung: document.getElementById("content").value,
                    nguoigui: receive_cc,
                    thoigian: formatDate(Date.now()),
                    starred: 0,
                    read: 1,
                    idFolder: 2,
                    username: $("#messName").text().trim(),
                };
                console.log(infoSent);
                // send mail from nguoigui
                fetch("./api/sendReceiveMail.php", {
                        method: "post",
                        headers: {
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify(infoSent),
                    })
                    .then(res => res.json())
                for (let i = 0; i < nguoinhan.length; i++) {
                    let recipient = nguoinhan[i].trim();
                    fetch('./api/findUserNameByEmail.php', {
                            method: 'post',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                email: recipient
                            })
                        })
                        .then(res => res.json())
                        .then(json => {
                            if (json.success === true) {
                                let infoReceive = {
                                    chude: document.getElementById("subject").value,
                                    noidung: document.getElementById("content").value,
                                    nguoigui: receive_cc,
                                    thoigian: formatDate(Date.now()),
                                    starred: 0,
                                    read: 0,
                                    idFolder: 1,
                                    username: json.data,
                                }
                                fetch('./api/sendReceiveMail.php', {
                                        method: 'post',
                                        headers: {
                                            'Content-Type': 'application/json'
                                        },
                                        body: JSON.stringify(infoReceive)
                                    })
                                    .then(res => res.json())
                                    .then(json => {
                                        if (json.code !== 0) {
                                            errorFlag = true;
                                        }
                                    })
                            } else {
                                alert("alert tồn tại tài khoản không hợp lệ");
                            }
                        })
                }
                if (errorFlag) {
                    alert("Thông báo có lỗi xảy ra");
                } else {
                    alert("Gửi email thành công");
                }
            // }
            }else if(document.getElementById("bcc").value !== ""){
                let to = document.getElementById("to").value;
                let bcc = document.getElementById("bcc").value;
                let errorFlag = false;
                let nguoigui = to;
                nguoigui += ',' + bcc;
                let nguoinhan = [...new Set(nguoigui.split(',').map(str => str.trim()))];
                nguoinhan.shift();
                let receive_cc = nguoinhan.join(", ");
                document.getElementById("bcc").value = nguoinhan.filter(item => item !== to);
                let infoSent = {
                    chude: document.getElementById("subject").value,
                    noidung: document.getElementById("content").value,
                    nguoigui: receive_cc,
                    thoigian: formatDate(Date.now()),
                    starred: 0,
                    read: 1,
                    idFolder: 2,
                    username: $("#messName").text().trim(),
                }   
                console.log(infoSent);
                // send mail from nguoigui
                fetch("./api/sendReceiveMail.php", {
                        method: "post",
                        headers: {
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify(infoSent),
                    })
                    .then(res => res.json())
                for (let i = 0; i < nguoinhan.length; i++) {
                    let recipient = nguoinhan[i].trim();
                    // console.log(recipient);
                    fetch('./api/findUserNameByEmail.php', {
                            method: 'post',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                email: recipient,
                            })
                        })
                        .then(res => res.json())
                        .then(json => {
                            if (json.success === true) {
                                let infoReceive = {
                                    chude: document.getElementById("subject").value,
                                    noidung: document.getElementById("content").value,
                                    nguoigui: document.getElementById("accountInfo").innerHTML,
                                    thoigian: formatDate(Date.now()),
                                    starred: 0,
                                    read: 0,
                                    idFolder: 1,
                                    username: json.data,
                                }
                                console.log(infoReceive);
                                fetch('./api/sendReceiveMail.php', {
                                        method: 'post',
                                        headers: {
                                            'Content-Type': 'application/json'
                                        },
                                        body: JSON.stringify(infoReceive)
                                    })
                                    .then(res => res.json())
                                    .then(json => {
                                        if (json.code !== 0) {
                                            errorFlag = true;
                                        }
                                    })
                            } else {
                                alert("alert tồn tại tài khoản không hợp lệ");
                            }
                        })
                }
                if (errorFlag) {
                    alert("Thông báo có lỗi xảy ra");
                } else {
                    alert("Gửi email thành công");
                }
            }
            else {
                let infoSent = {
                    chude: document.getElementById("subject").value,
                    noidung: document.getElementById("content").value,
                    nguoigui: document.getElementById("to").value,
                    thoigian: formatDate(Date.now()),
                    starred: 0,
                    read: 1,
                    idFolder: 2,
                    username: $("#messName").text().trim(),
                }
                fetch('./api/sendReceiveMail.php', {
                        method: 'post',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(infoSent)
                    })
                    .then(res => res.json())
                fetch('./api/findMailByUser.php', {
                        method: 'post',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            username: $("#messName").text().trim()
                        })
                    })
                    .then(res => res.json())
                    .then(json => {
                        if (json.success === true) {
                            let nguoigui1 = json.data;
                            fetch('./api/findUserNameByEmail.php', {
                                    method: 'post',
                                    headers: {
                                        'Content-Type': 'application/json'
                                    },
                                    body: JSON.stringify({
                                        email: document.getElementById("to").value
                                    })
                                })
                                .then(res => res.json())
                                .then(json => {
                                    if (json.success === true) {
                                        let infoReceive = {
                                            chude: document.getElementById("subject").value,
                                            noidung: document.getElementById("content").value,
                                            nguoigui: nguoigui1,
                                            thoigian: formatDate(Date.now()),
                                            starred: 0,
                                            read: 0,
                                            idFolder: 1,
                                            username: json.data,
                                        }
                                        fetch('./api/sendReceiveMail.php', {
                                                method: 'post',
                                                headers: {
                                                    'Content-Type': 'application/json'
                                                },
                                                body: JSON.stringify(infoReceive)
                                            })
                                            .then(res => res.json())
                                            .then(json => {
                                                if (json.code === 0) {
                                                    alert("Gửi email thành công");
                                                    $('#to').val("");
                                                    $('#subject').val("");
                                                    $('#content').val("");
                                                } else {
                                                    alert("Thông báo có lỗi xảy ra");
                                                }
                                            })
                                    }
                                })
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
        var inboxButton = document.getElementById("openInbox");
        var inboxDiv = document.getElementById("inbox");
        inboxButton.addEventListener("click", function() {
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
                    if (json.success === true) {
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
                                let a = [];
                                let ng ="";
                                let nn ="";
                                a = object["nguoigui"].split(","); 
                                if (a.length === 1){
                                    ng = object["nguoigui"].split(",")[0];
                                    nn = document.getElementById("accountInfo").innerHTML
                                }
                                else {
                                    for(i=1;i<a.length;i++){
                                    nn += a[i]+"||";
                                    }
                                    ng = object["nguoigui"].split(",")[0];
                                }
                                document.getElementById("email").style.display = "block";
                                myForm.style.display = "none";
                                importantDiv.style.display = "none";
                                trashDiv.style.display = "none";
                                inboxDiv.style.display = "none";
                                sentDiv.style.display = "none";
                                document.getElementById("from").textContent = "Người gửi: " + ng;
                                document.getElementById("emailto").textContent = "Đến: " + nn;
                                document.getElementById("header").textContent = "Chủ đề: " +object["chude"];
                                document.getElementById("detailContent").textContent = "Nội dung: " +  object["noidung"];
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
            document.getElementById("to").value = document.getElementById("from").textContent.substring(11);
            document.getElementById("subject").value = document.getElementById("header").textContent.substring(8);
            document.getElementById("content").value = "Reply: " + document.getElementById("detailContent").textContent.substring(10)+ "\n";
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
        sentButton.addEventListener("click", function() {
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
                                let a = [];
                                let ng ="";
                                let nn ="";
                                a = object["nguoigui"].split(","); 
                                if (a.length === 1){
                                    nn = object["nguoigui"].split(",")[0];
                                    ng = document.getElementById("accountInfo").innerHTML
                                }
                                else {
                                    for(i=1;i<a.length;i++){
                                    nn += a[i]+"||";
                                    }
                                    ng = object["nguoigui"].split(",")[0];
                                }
                                document.getElementById("email").style.display = "block";
                                myForm.style.display = "none";
                                importantDiv.style.display = "none";
                                trashDiv.style.display = "none";
                                inboxDiv.style.display = "none";
                                sentDiv.style.display = "none";
                                ///Đến
                                document.getElementById("from").textContent = "Người gửi: " + ng;
                                document.getElementById("emailto").textContent = "Đến: " + nn;
                                document.getElementById("header").textContent = "Chủ đề: "+object["chude"];
                                document.getElementById("detailContent").textContent = "Nội dung: " + object["noidung"];
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
        importantButton.addEventListener("click", function() {
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
                                document.getElementById("from").textContent = "Người gửi: " + object["nguoigui"];
                                document.getElementById("emailto").textContent = "Đến: " + document.getElementById("accountInfo").textContent;
                                document.getElementById("header").textContent = "Chủ đề: " + object["chude"];
                                document.getElementById("detailContent").textContent ="Nội dung: " + object["noidung"];
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
        trashButton.addEventListener("click", function() {
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
                                let a = [];
                                let ng ="";
                                a = object["nguoigui"].split(","); 
                                for(i=1;i<a.length;i++){
                                    ng += a[i]+"||";
                                }
                                document.getElementById("email").style.display = "block";
                                myForm.style.display = "none";
                                importantDiv.style.display = "none";
                                trashDiv.style.display = "none";
                                inboxDiv.style.display = "none";
                                sentDiv.style.display = "none";
                                document.getElementById("from").textContent = "Người gửi: " + object["nguoigui"].split(",")[0];
                                document.getElementById("emailto").textContent = "Đến: " + ng;
                                document.getElementById("header").textContent = "Chủ đề :" + object["chude"];
                                document.getElementById("detailContent").textContent ="Nội dung: " + object["noidung"];
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
                let starred = ""; 
                if (mail[i].starred === 1) {
                    starred = `<label class="starblack-checkbox">
                  <input type="checkbox"  id="${mail[i].id}"  onclick="changeStarred(this)" >
                  <span class="starblack"></span>
                  </label>`;
                } else {
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
                let starred = "";
                if (mail[i].starred === 1) {
                    starred = `<label class="starblack-checkbox">
                  <input type="checkbox"  id="${mail[i].id}"  onclick="changeStarred(this)" >
                  <span class="starblack"></span>
                  </label>`;
                } else {
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
              ${stringTitle}<span>-</span> ${mail[i].noidung.substring(0, 200)}
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
                let starred = "";
                if (mail[i].starred === 1) {
                    starred = `<label class="starblack-checkbox">
                  <input type="checkbox"  id="${mail[i].id}"  onclick="changeStarred(this)" >
                  <span class="starblack"></span>
                  </label>`;
                } else {
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
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        id: evt.id
                    }),
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
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        id: evt.id
                    }),
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
        function changeStarred(evt) {
            fetch("./api/update-starred.php", {
                    method: "put",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        id: evt.id
                    }),
                })
                .then((res) => res.json())
                .then((json) => {
                    if (json.code === 1) {
                        alert("Thay đổi thành công");
                    }
                })
        }
        function changeRead(id) {
            fetch("./api/update-read.php", {
                    method: "put",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        id: id
                    }),
                })
                .then((res) => res.json())
                .then((json) => {
                    if (json.code === 1) {
                        alert("Thay đổi thành công");
                    }
                })
        }
        function markRead(id) {
            fetch("./api/read.php", {
                    method: "put",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        id: id
                    }),
                })
                .then((res) => res.json())
                .then((json) => {})
        }
    </script>
</body>

</html>