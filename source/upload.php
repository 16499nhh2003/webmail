<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin người dùng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <style>
        body {
            background-color: #87A96B;
        }

        .card {
            border: none;
            background-color: #87A96B;
        }

        .image {
            position: relative
        }

        .image span {
            background-color: blue;
            color: #fff;
            padding: 6px;
            height: 30px;
            width: 30px;
            border-radius: 50%;
            font-size: 13px;
            position: absolute;
            display: flex;
            justify-content: center;
            align-items: center;
            top: -0px;
            right: 0px
        }

        .user-details h4 {
            color: blue
        }

        .ratings {
            font-size: 30px;
            font-weight: 600;
            display: flex;
            justify-content: left;
            align-items: center;
            color: #f9b43a
        }

        .user-details span {
            text-align: left
        }

        .inputs label {
            display: flex;
            margin-left: 3px;
            font-weight: 500;
            font-size: 13px;
            margin-bottom: 4px
        }

        .inputs input {
            font-size: 14px;
            height: 40px;
            border: 2px solid #ced4da
        }

        .inputs input:focus {
            box-shadow: none;
            border: 2px solid blue
        }

        .about-inputs label {
            display: flex;
            margin-left: 3px;
            font-weight: 500;
            font-size: 13px;
            margin-bottom: 4px
        }

        .about-inputs textarea {
            font-size: 14px;
            height: 100px;
            border: 2px solid #ced4da;
            resize: none
        }

        .about-inputs textarea:focus {
            box-shadow: none
        }

        .btn {
            font-weight: 600
        }

        .btn:focus {
            box-shadow: none
        }
    </style>
</head>

<body>
    <?php
if (isset($_GET['id'])) {
    require_once('./controller/usercontroller.php');
    $id = $_GET['id'];
    $user = (new UserController())->getUserById($id);
    if ($user->gioitinh === 0) {
        $ceg = 0;
    }
    if ($user->gioitinh === 1) {
        $ceg  = 1;
    }
    if ($user->gioitinh === 2) {
        $ceg  = 2;
    }
        global $conn;
        $stmt = $conn->prepare("SELECT image from `users` where id = ?");
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $stmt->bind_result($image);
        $stmt->fetch();
}
    ?>
    <form method="POST" action="upload.php?id=<?php echo $_GET['id']?>" enctype="multipart/form-data">
        <div class="container mt-3">
            <div class="card p-3 text-center">
                <div class="d-flex flex-row justify-content-center mb-3">
                    <div class="image"> <img style="width:100px;height:100px" src="./photo/<?php echo $image?>" class="rounded-circle"></div>
                </div>
                <h4>Thông tin cá nhân</h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="inputs"> <label>Giới tính</label>
                            <select class="form-select border border-dark" name="gioitinh" id="gioitinh">
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
                    <div class="col-md-6">
                        <div class="inputs"> <label>Họ và tên</label> <input class="form-control" type="text" placeholder="Tên"  name="fullName" value="<?php echo $user->fullname ?>"> </div>
                    </div>
                    <div class="col-md-6">
                        <div class="inputs"> <label>Tài khoản email</label> <input class="form-control" type="text" placeholder="Email" name="email"value="<?php echo $user->email ?>"></div>
                    </div>
                    <div class="col-md-6">
                        <div class="inputs"> <label>Ngày sinh</label> <input name="dob"  type="date" class="form-control border border-dark" id="dob" name="dob" value="<?php echo $user->dob ?>"></div>
                    </div>
                    <div class="col-md-6 pt-2">
                        <label style="float:left">Hình ảnh đại diện:</label>
                        <input type="hidden" name="size" value="1000000">
                        <input type="file" name="image">
                    </div>
                </div>
            </div>
            <div class="mt-3 gap-2 d-flex justify-content-end">
                <a href="./" class="px-3 btn btn-sm btn-outline-primary" role="button">Quay trờ về</a>
                <button  class="px-3 btn btn-sm btn-primary" type="submit" name="upload">Lưu</button>
            </div>
    </form>
</body>
<?php
include './controller/connectDB.php';
if (isset($_POST['upload'])){
    $errors = array();
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    $file_parts = explode('.', $_FILES['image']['name']);
    $file_ext = strtolower(end($file_parts));
    $expensions = array("jpeg", "jpg", "png");
    if (in_array($file_ext, $expensions) === false) {
        $errors[] = "Chỉ hỗ trợ upload file JPEG hoặc PNG.";
    }
    if ($file_size > 2097152) {
        $errors[] = 'Kích thước file không được lớn hơn 2MB';
    }
    $image = $_FILES['image']['name'];
    $target = "photo/" . basename($image);
    global $id;
    $fullname = $_POST['fullName'];
    $dob = $_POST['dob'];
    $gioitinh = $_POST['gioitinh'];
    $email = $_POST['email'];
    $stmt = $conn->prepare("update users set fullname = ? , dob = ? , gioitinh = ? , email = ? where id = ?");
    $stmt->bind_param('ssisi',$fullname,$dob,$gioitinh,$email,$id);
    $result = $stmt->execute();
    $sql = "Update users set image = '$image' where id = $id";
    mysqli_query($conn, $sql);
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        echo "<script>alert('ok') location.reload()</script>";
    } 
}
?>
</form>
</div>
</html>