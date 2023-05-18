<?php
session_start();
if (isset($_POST['btnlogin'])) {
    require_once('./controller/usercontroller.php');
    require_once('./controller/accountcontroller.php');
    $us = $_POST['email'];
    $_SESSION['username'] = $us;
    $block = (new AccountController())->block($us);
    if ($block === 1){
        die("Tài khoản của bạn hiện đang bị khóa!!! <a href='login.php'>Quay trở lại đăng nhập</a>");
    }
    $pw = $_POST['pwd'];
    $acc = (new AccountController())->login($us,$pw);
    if (isset($acc) && !empty($acc)){
        $user = (new UserController())->getUserById($acc);
        $userRole =  (new AccountController())->role($user->id);
        if($user && $userRole == 0){
            $_SESSION['name'] = $user->fullname;
            $_SESSION['email'] = $user->email;
            header("Location:ManageUser.php");
            die("chuyen sang trang index");
        }
        else if ($user && $userRole == 1) {
            $_SESSION['name'] = $user->fullname;
            $_SESSION['email'] = $user->email;
            $_SESSION['huyhoa'] = "ok";
            $_SESSION['id'] = $user->id;
            header("Location:index.php");
            die("Dang chuyen trang");
        }
    }  
    else{
        $msg = "Tên đăng nhập hoặc tài khoản không tồn tại";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link href="./Source/css/login.css" rel="stylesheet">
    <script>
        function check_data(event) {
            let email = $('#email').val().trim()
            let pwd = $('#pwd').val()
            if (email == '') {
                $('#msg').css('color', 'red').text('Vui lòng nhập tên đăng nhập')
                event.preventDefault()
                return false
            }
            // let reg = /^[a-z0-9_\.]+@[a-z]+\.[a-z]+(\.[a-z]+)?$/i
            // if (!email.match(reg)) {
            //     $('#msg').css('color', 'red').text('Your email is not correct')
            //     return false
            // }
            if (pwd == '') {
                $('#msg').css('color', 'red').text('Vui lòng nhập mật khẩu!')
                return false
            }
            if (pwd.length < 6) {
                $('#msg').css('color', 'red').text('Mật khẩu của bạn phải ít nhất 6 kí tự!!')
                return false
            }
            $('#msg').text('')
            console.log($('#msg').val);
            return true
        }
        $(function() {
            var pwdInput = document.getElementById('pwd');
            var showPwd = document.getElementById('showpwd');

            showPwd.addEventListener('click', function() {
                if (pwdInput.type === 'password') {
                    pwdInput.type = 'text';
                    showPwd.classList.remove('fa-eye');
                    showPwd.classList.add('fa-eye-slash');
                } else {
                    pwdInput.type = 'password';
                    showPwd.classList.remove('fa-eye-slash');
                    showPwd.classList.add('fa-eye');
                }
            });
            $('#btnsubmit').click(evt => {
                if (!check_data()) {
                    evt.preventDefault()
                    return
                }
                
                //evt.preventDefault()
                //$('#msg').css('color', 'rgb(77, 162, 109)').text('Gửi dữ liệu thành công')
            })
        })
    </script>
</head>

<body>
    <form action="" method="post">
        <h2 style="display: flex; text-align: center; justify-content: center;">Đăng Nhập</h2>
        <div class="form-group">
            <label for="username">Tên đăng nhập:</label>
            <div class="In">
                <i class="fa fa-user"></i>
                <input type="text" class="form-control decorate" id="email" placeholder="Nhập tên đăng nhập" name="email">
            </div>
        </div>
        <div class="form-group">
            <label for="pwd">Mật khẩu:</label>
            <div class="In">
                <i class="fa fa-key"></i>
                <input type="password" class="form-control decorate" id="pwd" placeholder="Nhập mật khẩu" name="pwd">
                <i class="fa fa-eye" id="showpwd"></i>
            </div>
        </div>
        <a href="ForgotPassword.php">Quên mật khẩu?</a>
        <div id="msg" class="mt-3 mb-3">
            <?php
                if(isset($msg) && !empty($msg)){
                    echo "<p style='color:red'>Tên đăng nhập hoặc mật khẩu không tồn tại.Vui lòng kiểm tra lại</p>";
                }
                $msg = "";
            ?>
        </div>
        <button name="btnlogin" class="btn" type="submit" id="btnsubmit" onclick="check_data(event)">Đăng nhập</button>
        <!-- <button name="btnSignIn" class="btn" id="btnsubmits"  >Đăng ký</button> -->
        <br> <br>
        <div style="white-space: nowrap; justify-content: center; align-items: center; display: flex;"><p style="padding-right: 10px; color: blue;"> Chưa có tài khoản thì bấm đăng ký </p><i class="fas fa-hand-point-down hand"></i></div>
        <button name="btnSignIn" class="btn" id="btnsubmits"  >Đăng ký</button>
    </form>
</body>
<script>
    $('#btnsubmits').on("click",(evt)=>{
        evt.preventDefault();
        window.location.href = "./Register.php";
    })
</script>
</html>