<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link href="./Source//css/home_admin.css" rel="stylesheet">
    <link href="./Source//css/setting.css" rel="stylesheet">
    <?php require_once("library.php") ?>
</head>

<body>
    <!-- Header -->
    <?php require_once("headerAdmin.php")?>

    <div class="container-fuild">
        <div class="row">
            <!-- sidebar -->
            <?php require_once("sidebarAdmin.php")?>
            <div class="settings col-9">
                <div class="row mt-4 option">
                    <div class="setting-form col-xl-12 col-lg-6 shadow col-12">
                        <div>Số lượng người nhận tối đa</div>
                        <hr>
                        <div>
                            <form>
                                <label for="numberaccount">Thiết lập số lượng người nhận tối đa:</label>
                                <input type="number" id="quantity" name="quantity" min="1" max="2000"><span>người</span><br><span>GB</span>
                                <label for="numberaccount">Thiết lập số lượng người nhận tối đa:</label>
                                <select style="width: 70px;">
                                    <option>1</option>
                                    <option>10</option>
                                    <option>100</option>
                                    <option>1000</option>
                                </select> <span>GB</span>
                                <div>
                                    <input type="checkbox" id="limit-attach">
                                    <label for="limit-attach">Giới hạn kích thước tập tin đính kèm:</label>
                                    <input type="number">
                                    <select style="width: 70px;">
                                        <option>1</option>
                                        <option>10</option>
                                        <option>100</option>
                                        <option>1000</option>
                                    </select>
                                </div>
                                <div>
                                    <label>Số lượng tập tin đính kèm:</label>
                                    <input type="number"><span>(values:0-1024)</span>
                                </div>
                                <div>
                                    <input type="checkbox">
                                    <label>Kích thước mail khi gửi:</label>
                                    <input type="number">
                                    <select style="width: 70px;">
                                        <option>1</option>
                                        <option>10</option>
                                        <option>100</option>
                                        <option>1000</option>
                                    </select>
                                </div>
                                <div>
                                    <label>Giới hạn số người nhận</label>
                                    <input type="number"><span>(values:0-1024)</span>
                                </div>
                                <div>
                                    <button>Xác Nhận</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <?php require_once("footerAdmin.php")?>
    <!-- Footer -->
    <script src="./Source//js//settings.js"></script>
    <script src="./Source//js//home_admin.js"></script>

</body>

</html>