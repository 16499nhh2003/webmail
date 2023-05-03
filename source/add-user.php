<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css -->
    <link href="./Source/css/home_admin.css" rel="stylesheet">
    <!-- <link href="./Source/css/profile_user.css" rel="stylesheet"> -->
    <!-- lib -->
    <?php require_once("library.php") ?>
    <!-- ../Source/css/LockUser.css -->
    <link href="./Source/css/LockUser.css" rel="stylesheet">
    <title>Trang thêm thông tin người dùng</title>
</head>

<body>
    <?php require_once('headerAdmin.php'); ?>
    <!-- ======= Sidebar ======= -->
    <div class="container-fuild">
        <div class="row">
            <?php require_once("sidebarAdmin.php") ?>
            <div class="col-9 p-0">
                <div style="padding: 20px; font-size: 20px;">
                    <p class="p-0 m-0">
                        <?php
                        if (isset($_GET['create']) && ($_GET['create']) === "add") {
                            echo "Thêm Người Dùng";
                        }
                        ?>
                    </p>
                </div>
                <form action="" method="post" style="width:50%;margin-left: 200px;">
                    <a href="./ManageUser.php" class="btn btn-info" style="float:right" role="button">Quay về </a>
                    <div><button name="btn-add" id="btnsubmit" style="width: 20%;float:right" type="submit" class="btn btn-info">Thêm</button></div>

                    <label style="color: blue;padding:3px" for="name">Họ và tên</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-user fa-beat"></i></span>
                        <input type="text" class="form-control border border-dark" id="name" name="name" placeholder="Nhập họ và tên">
                    </div>

                    <label style="color: blue;padding:3px" for="dob">Ngày Sinh</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-user fa-beat"></i></span>
                        <input type="date" class="form-control border border-dark" id="dob" name="dob">
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
                        <input name="password" type="text" class="form-control border border-dark" placeholder="Mật khẩu" id="password"><br>
                    </div>

                    <label style="color: blue;padding:3px" for="confirmPassword">Xác Nhận Mật Khẩu:</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-lock fa-beat"></i></span>
                        <input name="confirmPassword" type="text" class="form-control border border-dark" placeholder="Xác nhận mật khẩu" id="confirmPassword"><br>
                    </div>
                    <div id="msg"></div>
                </form>
            </div>
        </div>
        <!-- Footer -->
        <?php
        require_once('footerAdmin.php');
        ?>
        <!-- Footer -->
        <!-- <script src="./Source/js/home_admin.js"></script> -->
        <!-- <script src="./Source/js/LockUser.js"></script> -->
        <script src="./Source/js/checkValid.js"></script>

        <script>
            let form = document.getElementsByTagName('form')[1];
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
                                alert("Thêm Thất Bại");
                            }
                        })
                        .then(res => res.json())
                        .then(json => {
                            if (json.code === 0) {
                                alert('Thêm thành công')
                                window.location = "./ManageUser.php";
                            }
                        })
                        .catch(error => console.log(error));
                }
            })
        </script>
</body>

</html>