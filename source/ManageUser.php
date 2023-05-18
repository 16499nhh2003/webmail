<?php
session_start();
$name= "";
if (isset($_SESSION['name']) && !empty($_SESSION['name'])){
    $name = $_SESSION['name'];
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
    <!-- <link href="./Source/css/profile_user.css" rel="stylesheet"> -->
    <!-- lib -->
    <?php require_once("library.php") ?>
    <link href="../Source/css/LockUser.css" rel="stylesheet">
    <title>Trang thông tin người dùng</title>
    <script>
        function showUser(users) {
            let tb = $("#users")
            tb.find('tr').remove()
            let tr = ''
            for (let i = 0; i < users.length; i++) {
                let blocked = (users[i].blocked === 0) ? "Mở" : "Đóng";
                let mess = (users[i].blocked === 0) ? "Khóa tài khoản" : "Mở tài khoản";
                let color =  (users[i].blocked === 0) ? "btn-danger" : "btn-primary";
                tr += 
                `<tr id="${users[i].id}">
                    <td>${users[i].id}</td>
                    <td>${users[i].fullname}</td>
                    <td>${users[i].username}</td>
                    <td>${blocked}</td>
                    <td>${users[i].ngaylap}</td>
                    <td><a id="${users[i].id}" tag ="${users[i].username}" role="button" class="btn btn-danger popover-test btn-delete" data-bs-toggle="modal" data-bs-target="#modal-delete" onclick="onchange_delete(this)">Xóa</a></td>
                    <td><a id="${users[i].id}" tag= "${users[i].username}" role="button" class="btn btn-primary popover-test" onclick="onchange_edit(this)">Sửa</a></td>
                    <td><button id="${users[i].username}" class="btn-lock btn ${color}" onclick="handleClick(this)">${mess}</button></td>
                </tr>`
            }
            tb.append(tr)
        }

        function handleClick(button) {
            let id = button.id;
            fetch('./api/blockUnblock.php',{
                method: 'PUT',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({username: id})}
            )
            .then(res => res.json())
            .then(json =>{
                if(json.code === 1){
                    alert('Thành công');
                    getUser();
                }
                else{
                    alert('Thất bại');
                }
            })
            .catch(error => console.log(error))
        }

        function getUser() {
            fetch('./api/get-user.php')
                .then(res => res.json())
                .then(json => {
                    if (json.success) {
                        showUser(json.data);
                    } else {
                        alert(json.message)
                    }
                })
        }

        // button update
        function onchange_edit(evt) {
            let id = evt.id;
            window.location.href = "ProfileUser.php?id=" + id;
        }

        // btn delete
        function onchange_delete(evt) {
            let id = evt.id;
            let tag = evt.getAttribute("tag");
            $('#modal-delete .modal-body').text(`Chắc chắn muốn xóa tài khoản usename : ${tag}`);
            $('#btn-delete-conf').on('click', () => {
                // delete user
                fetch('./api/delete-user.php', {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            id: id
                        })
                    })
                    .then(res => res.json())
                    .then(json => {
                        if (json.code === 0) {
                            alert("Xóa thành công")
                        }
                    })
                fetch('./api/delete-account.php', {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id: id
                    })
                })
                getUser();
            })
        }
        $(function() {
            getUser();
            // Hiện thông báo thành công khi thêm
            $('.alert').show();
            setTimeout(function() {
                $('.alert').hide()
            }, 2000);

            //  button add
            $("#btnadd").on("click", () => {
                window.location.href = "add-user.php?create=add";
            })

        })
    </script>
</head>

<body>
    <?php
    $msg = "";
    $suss = "";
    require_once('headerAdmin.php');
    ?>
    <!-- ======= Sidebar ======= -->
    <div class="container-fuild">
        <div class="row">
            <?php require_once("sidebarAdmin.php") ?>
            <div class="col-9 p-0">
                <!-- <div style="padding: 20px; font-size: 20px;">
                    <p class="p-0 m-0">Quản lý người dùng</p>
                </div> -->
                <div>
                    <div class="row">
                        <!-- <div class="col-3 p-3 text-center"><span>Tìm kiếm</span></div>
                        <div class="col-6 p-1 text-center">
                            <input type="text" placeholder="Username" class="w-100 p-3" style="border-radius: 20px;">
                        </div> -->
                        <div class="col-3 text-center" style="margin-top:10px"><button type="button" id="btnadd" class="btn btn-success p-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Thêm tài khoản</button></div>
                    </div> 
                    <div class="mt-4" style="padding: 15px;">
                        <div class="" style="margin-bottom: 20px">
                            <div class="card-body">
                                <h5 class="card-title">Danh Sách Người Dùng</h5>
                            </div>
                        </div>
                        <table class="table datatable table-bordered border-dark text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">Số tài khoản</th>
                                    <th scope="col">Tên đăng nhập</th>
                                    <th scope="col">Tên người dùng</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Ngày lập</th>
                                    <th scope="col">Xóa</th>
                                    <th scope="col">Sửa</th>
                                    <th scope="col">Khóa</th>
                                </tr>
                            </thead>
                            <tbody id="users"></tbody>
                            <tfoot class="table-dark">
                                <tr>
                                    <th scope="col">Số tài khoản</th>
                                    <th scope="col">Tên đăng nhập</th>
                                    <th scope="col">Tên người dùng</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Ngày lập</th>
                                    <th scope="col">Xóa</th>
                                    <th scope="col">Sửa</th>
                                    <th scope="col">Khóa</th>
                                </tr>
                            </tfoot>
                        </table>

                        <!-- Phan trang -->
                        <!-- <nav style="float: right;margin-right:10px">
                            <ul class="pagination">
                                <?php for ($i = 1; $i <= $totalPage; $i++) { ?>
                                        <li class="page-item"><a class="page-link" href="?per_page=3&page=<?= $i ?>"><?= $i ?></a></li>
                                <?php } ?>
                            </ul>
                        </nav> -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <?php require_once('footerAdmin.php'); ?>
        <!-- Footer -->

        <!-- Modal Delete -->
        <div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Xác nhận xóa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <a id="btn-delete-conf" role="button" class="btn btn-danger" data-bs-toggle="modal">Xóa</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- script -->
        <script src="./Source/js/home_admin.js"></script>
        
</body>

</html>