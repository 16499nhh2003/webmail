<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <?php require_once("library.php"); ?>
    <link href="./Source/css/home_admin.css" rel="stylesheet">
</head>
<body>
    <!-- footer  -->
    <?php require_once("headerAdmin.php")?> 

    <!-- container  -->
    <div class="container-fuild" >
        <div class="row">
            <!-- Sidebar -->
        <?php require_once("sidebarAdmin.php")?>
        <div class="col-9 bg-light p-0 main-right">
                <div class="row p-2">
                    <div class="col-lg-3 col-xl-3 col-xxl-3 col-md-6 col-12 card-item mb-3" style="height:400px;">
                        <div class="card" style="height: 100%;">
                            <img src="./Source/img/H1_manageuser.jpg" class="card-img-top" style="height: 60%;">
                            <div class="card-body">
                                <div>
                                    <h5 class="card-title">Quản Lý Tài Khoản</h5>
                                    <p class="card-text">Thống kê người dùng</p>
                                </div>
                                <a href="./ManageUser.php" class="btn btn-primary btn-item">Go to page</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xl-3 col-xxl-3 col-md-6 col-12 card-item mb-3" style="height:400px;">
                        <div class="card" style="height: 100%;">
                            <img src="./Source/img/H2_Admin.png" class="card-img-top" style="height: 60%;">
                            <div class="card-body">
                                <div>
                                    <h5 class="card-title">Quản Lý Keyword</h5>
                                    <p class="card-text">Thêm xóa sửa các keyword</p>
                                </div>
                                <a href="./settings.php" class="btn btn-primary">Go to page</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xl-3 col-xxl-3 col-md-6 col-12 card-item mb-3" style="height:400px;">
                        <div class="card" style="height: 100%;">
                            <img src="./Source/img/H3_Admin.jpg" class="card-img-top" style="height: 60%;">
                            <div class="card-body">
                                <div>
                                    <h5 class="card-title">Số lượng người nhận</h5>
                                    <p class="card-text">Thống kê số lượng</p>
                                </div>
                                <a href="./settings.php" class="btn btn-primary">Go to page</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xl-3 col-xxl-3 col-md-6 col-12 card-item mb-3" style="height:400px;">
                        <div class="card" style="height: 100%;">
                            <img src="./Source/img/H4_admin.png" class="card-img-top" style="height: 60%;">
                            <div class="card-body">
                                <div>
                                    <h5 class="card-title">Giới hạn số tập tin </h5>
                                    <p class="card-text">Quản lý tập tin</p>
                                </div>
                                <a href="./settings.php" class="btn btn-primary">Go to page</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--  -->
    <?php require_once("footerAdmin.php");?>
    <script src="./Source/js/home_admin.js"></script>
</body>

</html>