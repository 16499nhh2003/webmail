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
    <title>gmail</title>
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

                <div id="messName" style="display:none;"class="appear">
                    <?php
                    if (isset($_SESSION['username'])) {
                        echo $username = $_SESSION['username'];
                    } ?>
                </div>
        

                <div class="spaceSearch">
                    <button  id="findUser" class="btn-circle"><span class="material-symbols-outlined">search</span></button>
                    <input  id="findContent" type="text" placeholder="Tìm kiếm" >
                </div>

                <div class="account">
                    <button class="btn-circle2" id="account">
                        <span class="material-symbols-outlined">person</span>
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
                        <strong>Soạn mail</strong>
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
                <!-- <button class="sidebarOption" id="openAlreadyRead">
                    <div>
                        <span class="material-symbols-outlined">mark_email_read</span>
                        <strong>&emsp; Already read</strong>
                    </div>
                </button> -->
                <!-- <button class="sidebarOption" id="openUnread">
                    <div>
                        <span class="material-symbols-outlined">mail</span>
                        <strong>&emsp; Unread</strong>
                    </div>
                </button> -->
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
            <div id ="inbox" class="col-10 overflow-auto" style="background-color: #F6F8FC;height: 88.7vh;">
                <div class="row">
                    <div id="rowInbox"> 
                        <div class="emailRow" ></div>
                    </div>
                </div>
            </div>
            <!-- Inbox component -->

            <!-- Sent component -->
            <div id ="sent" class="col-10 overflow-auto" style="background-color: #F6F8FC;height: 88.7vh; display: none; z-index: 10;">
                <div class="row">
                    <div id="rowSent"> 
                        <div class="emailRow" ></div>
                    </div>
                </div>
            </div>
            <!-- Sent component -->

            <!-- Important component -->
            <div id ="important" class="col-10 overflow-auto" style="background-color: #F6F8FC;height: 88.7vh; display: none; z-index: 10;">
                <div class="row">
                    <div id="rowImportant"> 
                        <div class="emailRow" ></div>
                    </div>
                </div>
            </div>

            <!-- Trash component -->
            <div id ="trash" class="col-10 overflow-auto" style="background-color: #F6F8FC;height: 88.7vh; display: none; z-index: 10;">
                <div class="row">
                    <div id="rowTrash"> 
                        <div class="emailRow" ></div>
                    </div>
                </div>
            </div>
            <!-- Trash component -->
                <!-- readEmail -->
                <div id ="email" class="col-10" style="background-color: #F6F8FC;height: 88.7vh; display: none; overflow-y: auto; 
                padding: 20px;  flex-direction: column; ">
                    <div class="row">
                        <div class="email-header">
                            <p id="from"></p>
                            <p id="emailto"></p>
                            <h3 id="header"></h3>
                        </div>
                        <div class="email-body">
                            <p id="detailContent">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Vestibulum ut massa nisi. Sed malesuada ultricies mauris, 
                                sit amet faucibus odio mollis nec. Vestibulum ante ipsum primis 
                                in faucibus orci luctus et ultrices posuere cubilia Curae;
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Vestibulum ut massa nisi. Sed malesuada ultricies mauris, 
                                sit amet faucibus odio mollis nec. Vestibulum ante ipsum primis 
                                in faucibus orci luctus et ultrices posuere cubilia Curae;
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Vestibulum ut massa nisi. Sed malesuada ultricies mauris, 
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                      
                                </p>
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
    <form action="" method="post" id="formSentMail">
        <div id="myForm" class="gmail_compose">
            <div class="header_compose">
                <p style="padding-left: 10px;">New mail</p>
                <button style="padding-right: 10px;" type="button" class="Close" id="closeForm">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <div class="body_compose">
                <input type="text" placeholder="To" id="to">
                <input type="text" placeholder="Subject" id="subject">
                <input type="text" placeholder="Cc" id="cc">
                <input type="text" placeholder="Bcc">
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
                <h6><strong><?php echo $_SESSION['name']?></strong></h6>
                <p id="accountInfo"><?php echo $_SESSION['email']  ?></p>
            </div>
            <div class="footer_account">
                <!-- <a href="Logout.php" style="text-decoration:none">Đăng Xuất</a> -->
                <a href="changePassword.php" style="text-decoration:none">Đổi mật khẩu</a><br>
                <a href="Logout.php" style="text-decoration:none">&nbsp Đăng Xuất</a>

                <!-- <button class="btn-logout" onclick="logOut()"><span class="material-symbols-outlined">logout</span>&emsp</button> -->
            </div>
        </form>
        <!-- Logout form -->
    <!-- script -->
    <script src = "./Source/js/index.js"></script>
</body>

</html>