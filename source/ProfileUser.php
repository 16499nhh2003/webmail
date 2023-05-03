<?php
require_once('./controller/usercontroller.php');
$ceg = "";
$id = "";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user = (new UserController())->getUserById($id);
    if ($user->gioitinh === 0) {
        $ceg = 0;
    }
    if ($user->gioitinh === 1) {
        $ceg  = 1;
    }
    if ($user->gioitinh === 2) {
        $ceg  = 21;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css -->
    <link href="./Source/css/home_admin.css" rel="stylesheet">
    <link href="./Source/css/profile_user.css" rel="stylesheet">
    <!-- lib -->
    <?php require_once("library.php") ?>
    <link href="../Source/css/LockUser.css" rel="stylesheet">
    <title>Trang thông tin người dùng</title>
</head>

<body>
    <?php
    require_once('headerAdmin.php');
    ?>

    <!-- ======= Sidebar ======= -->
    <div class="container-fuild">
        <div class="row">
            <?php require_once("sidebarAdmin.php") ?>
            <div class="col-xl-9" style="margin-top:50px">
                <form method="post">
                    <div class="row mb-3">
                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Họ và Tên</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="fullName" type="text" class="form-control" id="fullName" value="<?php echo $user->fullname ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="dob" class="col-md-4 col-lg-3 col-form-label">Ngày Sinh</label>
                        <div class="col-md-8 col-lg-9">
                            <input type="date" class="form-control border border-dark" id="dob" name="dob" value="<?php echo $user->dob ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="email" type="email" class="form-control" id="email" value="<?php echo $user->email ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-lg-3 col-form-label" for="sex">Giới Tính</label>
                        <div class="col-md-8 col-lg-9">
                            <select class="form-select border border-dark" name="giotinh" id="gioitinh">
                                <option value="0" <?php if ($ceg == 0) {
                                                        echo 'selected';
                                                    } ?>>Nam</option>
                                <option value="1" <?php if ($ceg == 1) {
                                                        echo 'selected';
                                                    } ?>>Nữ</option>
                                <option value="2" <?php if ($ceg == 2) {
                                                        echo 'selected';
                                                    } ?>>Khác</option>
                            </select>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" tag="<?php echo $id ?>" id="btnSave">Lưu </button>
                        <a href="./ManageUser.php" class="btn btn-info" role="button">Quay trờ về</a>
                    </div>
                </form><!-- End Profile Edit Form -->
            </div>

        </div>
    </div>

    <!-- Footer -->
    <?php require_once('footerAdmin.php'); ?>
    <!-- Footer -->

    <!-- script -->
    <script src="./Source/js/home_admin.js"></script>
    <!-- <script src="./Source/js/Register.js"></script> -->
    <!-- <script src="./Source/js/LockUser.js"></script> -->

    <script>
        let form = document.getElementsByTagName('form')[1];
        let btnSave = document.getElementById('btnSave')
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            let user = {
                id: btnSave.getAttribute("tag"),
                fullname: document.getElementById('fullName').value,
                dob: document.getElementById('dob').value,
                email: document.getElementById('email').value,
                gioitinh: document.getElementById('gioitinh').value,
            }
            fetch('./api/update-user.php', {
                    method: 'put',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(user)
                })
                .then(res => res.json())
                .then(json => {
                    if (json.message === true) {
                        alert('Thay đổi thành công')
                        window.location = "./ManageUser.php";
                    } else {
                        alert("Thay đổi thất bại")
                    }
                })
                .catch(error => console.log(error));
        })
    </script>
    

</body>

</html>


<!-- Phân trang người dùng , Khóa người dùng , Chuyển tiếp tin nhắn , chuyển tin nhắn vào thư mục important -->