<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../Source/css/Register.css" rel="stylesheet">
    <?php require_once("library.php") ?>
    <title>Thay đổi mật khẩu</title>
</head>

<body>
    <div class="row">
        <div class="col-md-6 col-12 text-center">
            <img class="img-fluid" style="height:100%" src="./Source//img//changePassword.png" >
        </div>
        <div class="col-md-6 col-12 pl-5 pl-md-2 p-4">
            <div>
                <p style="color:blue;font-weight: 500;font-size: 25px;">Đổi mật khẩu</p>
            </div>
            <form action="" method="post">
                <p>Tên đăng nhập</p>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-user fa-beat"></i></span>
                    <input name="username" type="text" class="form-control border border-dark" id="username" placeholder="Nhập tên đăng nhập" >
                </div>
                
                <p>Mật khẩu hiện tại</p>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-lock fa-beat"></i></span>
                    <input name="pwdo" type="password" class="form-control border border-dark" placeholder="Mật khẩu hiện tại" id="passwordOld"><br>
                    <span class="input-group-text border border-dark"><i class="fa-solid fa-eye-slash eye" onclick="changestatus(this,'passwordOld')"></i></span>
                </div>
                <p>Mật khẩu mới</p>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-lock fa-beat"></i></span>
                    <input name="pwdn" type="password" class="form-control border border-dark" placeholder="Mật khẩu mới" id="passwordNew"><br>
                    <span class="input-group-text border border-dark"><i class="fa-solid fa-eye-slash eye" onclick="changestatus(this,'passwordNew')"></i></span>
                </div>
                <p>Xác nhận mật khẩu mới</p>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-lock fa-beat"></i></span>
                    <input name="pwdconfirm" type="password" class="form-control border border-dark" placeholder="Xác nhận mật khẩu mới" id="confirmPasswordNew"><br>
                    <span class="input-group-text border border-dark "><i class="fa-solid fa-eye-slash eye" onclick="changestatus(this,'confirmPasswordNew')"></i></span>
                </div>
                <div id="msg" class="mb-3" style="color:red"></div>
                <div  style="margin-bottom:10px"><a href = "index.php" style="text-decoration:none">Quay lại trang chủ</a></div>
                <div>
                    <button name="btn-changepass" id="btnsubmit" style="width: 100%;" class="btn btn-primary">Đổi mật khẩu</button>
                </div>
            </form>
        </div>
    </div>
    <?php require_once("footerClient.php")?>
    <!-- script -->
    <script src="./Source/js/changePassword.js"></script>
    
</body>
</html>