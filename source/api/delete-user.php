<?php
header('Content-Type: application/json; charset=utf-8');
    $method = $_SERVER['REQUEST_METHOD'];
    $raw =  file_get_contents('php://input');
    $data = json_decode($raw);
    $id = $data->id;
    if($method === 'DELETE'){
        require_once('../controller/usercontroller.php');
        $user = new UserController();
        $userResult = $user->delete($id);
        if($userResult){
            die(json_encode(array('code'=>0,"mess"=>"Xoa thanh cong")));
        }
        else{
            die(json_encode(array("code"=>1,"mess"=>'Xóa thất bại')));
        }
    }
?>
