<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fuild">
        <a class="navbar-brand" href="#" style="margin-left:30px;font-size: 35px;">Xin chào admin:<?php
        if (isset($name)){
            echo $name;
        }?></a>
    </div>
    <form class="d-flex ms-auto">
        <div class="dropdown dropstart" style="margin-right: 30px;">
            <a href="Logout.php" style="text-decoration:none">Đăng Xuất</a>
        </div>
    </form>
</nav>