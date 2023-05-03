<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css -->
    <link href="../Source/css/Register.css" rel="stylesheet">
    <!-- lib -->
    <?php require_once("library.php") ?>
    <title>Trang Đăng Ký</title>
</head>

<body>
    <div class="row">
        <div class="col-md-6 col-12 text-center" style="background-color: #EAF2FC;">
            <img class="img-fluid" style="height:100%;" src="./Source//img//img-signup.png">
        </div>
        <div class="col-md-6 col-12 pl-5 pl-md-2 p-4">
            <div>
                <p style="color:blue;font-weight: 500;font-size: 25px;">Chào mừng bạn đến với webmail</p>
                <p style="font-weight: 500;">Đăng kí ngay để có có những trải nghiệm thú vị hơn</p>
            </div>
            <form action="" method="post">
                <label style="color: blue;padding:3px" for="name">Họ và tên</label>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-user fa-beat"></i></span>
                    <input type="text" class="form-control border border-dark" id="name" name="name" placeholder="Nhập họ và tên">
                </div>

                <label style="color: blue;padding:3px" for="dob">Ngày Sinh</label>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-user fa-beat"></i></span>
                    <input type="date" class="form-control border border-dark" id="dob" name="dob" placeholder="Nhập họ và tên">
                </div>

                <label style="color: blue;padding:3px" for="sex">Giới Tính</label>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-user fa-beat"></i></span>
                    <select class="form-select border border-dark" name="gt" id="gt">
                        <option value="0">Nam</option>
                        <option value="1">Nữ</option>
                        <option value="2">Khác</option>
                    </select>
                </div>


                <label style="color: blue;padding:3px" for="username">Tài Khoản Email:</label>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-envelope fa-beat"></i></span>
                    <input name="email" type="text" class="form-control border border-dark" id="email" placeholder="Nhập tài khoản email"><br>
                </div>

                <label style="color: blue;padding:3px" for="username">Tên Đăng Nhập:</label>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-envelope fa-beat"></i></span>
                    <input name="username" type="text" class="form-control border border-dark" id="username" placeholder="Tên đăng nhập"><br>
                </div>


                <label style="color: blue;padding:3px" for="password">Mật Khẩu:</label>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-lock fa-beat"></i></span>
                    <input name="password" type="password" class="form-control border border-dark" placeholder="Mật khẩu" id="password"><br>
                    <span class="input-group-text border border-dark"><i class="fa-solid fa-eye-slash eye" onclick="changestatus(this,'password')"></i></span>
                </div>

                <label style="color: blue;padding:3px" for="confirmPassword">Xác Nhận Mật Khẩu:</label>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-lock fa-beat"></i></span>
                    <input name="confirmPassword" type="password" class="form-control border border-dark" placeholder="Xác nhận mật khẩu" id="confirmPassword"><br>
                    <span class="input-group-text border border-dark "><i class="fa-solid fa-eye-slash eye" onclick="changestatus(this,'confirmPassword')"></i></span>
                </div>

                <div id="msg"></div>
                <div><button name="btn-add" id="btnsubmit" style="width:100%" type="submit" class="btn btn-info">Đăng Ký</button></div>
            </form>
        </div>
    </div>
    <?php require_once("footerClient.php") ?>

    <script src="./Source/js//checkValid.js"></script>
    <script>
        let form = document.getElementsByTagName('form')[0];
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                if (checkValid()) {
                    let user = {
                        fullname: document.getElementById('name').value,
                        dob: document.getElementById('dob').value,
                        gioitinh: document.getElementById('gt').value,
                        email: document.getElementById('email').value,
                    }
                    console.log(user)
                    fetch('./api/add-user.php', {
                            method: 'post',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify(user)
                        })
                        .then(res => res.json())
                        .then(json => {
                            if (json.code === 0) {
                                let accountUser = {
                                    username: document.getElementById('username').value,
                                    password: document.getElementById('password').value,
                                    idUser: json.data,
                                }
                                return fetch('./api/add-account.php', {
                                    method: 'post',
                                    headers: {
                                        'Content-Type': 'application/json'
                                    },
                                    body: JSON.stringify(accountUser)
                                })
                            } else {
                                alert("Bạn đã có tài khoản ? Vui lòng kiểm tra lại!!");
                            }
                        })
                        .then(res => res.json())
                        .then(json => {
                            if (json.code === 0) {
                                alert('Tạo tài khoản thành công')
                                window.location = "Register.php";
                            }
                        })
                        .catch(error => console.log(error));
                }
            })
    </script>
</body>

</html>