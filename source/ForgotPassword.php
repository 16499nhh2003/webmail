<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- lib -->
    <?php require_once("library.php") ?>
    <title>Document</title>
</head>

<body>
    <div class="container-fuild">
        <div class="row">
            <div class="col-md-6 col-12 text-center" style="background-color: #EAF2FC;">
                <img class="img-fluid" style="height:100%;" src="./Source/img/ForgotPassword.png">
            </div>
            <div class="col-md-6 col-12 pl-5 pl-md-2 p-4">
                <div>
                    <p style="color:blue;font-weight: 500;font-size: 25px;">Quên mật khẩu</p>
                </div>
                <?php
                use PHPMailer\PHPMailer\PHPMailer;
                use PHPMailer\PHPMailer\SMTP;
                if (isset($_POST['email'])) {
                    require_once('./controller/mailcontroller.php');
                    require_once('./controller/accountcontroller.php');
                    $usname = (new MailController())->findUserNameByEmail($_POST['email']);
                    $passNew = rand(100000,120000);
                    $acc = (new AccountController())->fogotPass($usname,$passNew);
                    require './vendor/autoload.php';
                    $mailReceive = $_POST['email'];
                    $mail = new PHPMailer(true);
                    try {
                        $mail->SMTPDebug = 0;
                        $mail->isSMTP();  
                        $mail->CharSet  = "utf-8";
                        $mail->Host = 'smtp.gmail.com';  //SMTP servers
                        $mail->SMTPAuth = true; // Enable authentication
                        $nguoigui = 'nguyenhuyhoa2003@gmail.com';
                        $matkhau = 'ikqcyldsbhjdygfr';
                        $tennguoigui = 'Admin Giấu Tên';
                        $mail->Username = $nguoigui; // SMTP username
                        $mail->Password = $matkhau;   // SMTP password
                        $mail->SMTPSecure = 'ssl';  // encryption TLS/SSL 
                        $mail->Port = 465;  // port to connect to                
                        $mail->setFrom($nguoigui, $tennguoigui ); 
                        $to = $_POST['email'];
                        $to_name = "Fullname";
                        
                        $mail->addAddress($to, $to_name); //mail và tên người nhận  
                        $mail->isHTML(true);  // Set email format to HTML
                        $mail->Subject = 'Cập nhật mật khẩu mới!!!';      
                        // getPassword 
                        $noidungthu = "<b>Xin chào!</b><br>Mật khẩu là mới của bạn là:".$passNew ;
                        $mail->Body = $noidungthu;
                        $mail->smtpConnect( array(
                            "ssl" => array(
                                "verify_peer" => false,
                                "verify_peer_name" => false,
                                "allow_self_signed" => true
                            )
                        ));
                        $mail->send();
                        $mess = 'Mật khẩu đã được gửi về tài khoản của bạn =>>>> Vui lòng kiểm tra!';
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                } 
                ?>
                    <form METHOD="post" action="ForgotPassword.php">
                        <p style="color: blue;">Email</p>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa-solid fa-envelope fa-beat"></i></span>
                            <input name="email" type="text" class="form-control border border-dark" id="email" placeholder="Nhập email" value="<?php if(isset($mailReceive)){echo $mailReceive;} ?>">
                        </div>
                        <div>
                            <p style="display: inline;color:black;">Quay lại đăng nhập</p>
                            <a href="login.php" style="text-decoration: none;">&nbspĐăng nhập</a><br>
                            <span style="color:black;">Tạo tài khoản mới ?</span>
                            <a href="Register.php" style="text-decoration: none;">&nbspĐăng Ký</a><br>
                            <span style="color:black;">Đổi mật khẩu?</span>
                            <a href="changePassword.php" style="text-decoration: none;">&nbspĐổi mật khẩu</a>
                            <?php
                                if (isset($mess) && !empty($mess)){
                                    echo '<br><p style="color:red">'.$mess."</p>";
                                }
                            ?>
                            <button name="btnsubmit" id="btnsubmit" style="width: 100%;" type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Xác nhận</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>

    <!--    Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Quên mật khẩu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button id="btnClose" type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
    <!-- footer -->
    <?php require_once("footerClient.php") ?>
       <script src="../Source/js/ForgotPassword.js"></script>
</body>

</html>