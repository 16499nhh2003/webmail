<?php
header('Content-Type: application/json; charset=utf-8');
    $method = $_SERVER['REQUEST_METHOD'];
    if($method === 'GET')
        {
            require_once ('../controller/usercontroller.php');
            $user = new UserController();
            $data = array("success"=>true,"data"=>$user->getAllUser());
            die(json_encode($data));
        }
?>