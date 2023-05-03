<?php
    header('Content-Type: application/json; charset=utf-8');
    $method = $_SERVER['REQUEST_METHOD'];
    if($method !== 'POST'){
        die(json_encode(array('message'=>'API chỉ chấp nhận method POST')));
    }
    else{
        $raw = file_get_contents('php://input') ;
        $json = json_decode($raw) ;
        $_POST['username'] = $json->username;
        $_POST['password'] = $json->password;
        $_POST['idUser'] = $json->idUser;
        if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['idUser'])){
            $username = $_POST['username'];
            $password = ($_POST['password']);
            $idUser = $_POST['idUser'];
            require_once ('../controller/accountcontroller.php');
            $account = new AccountController();
            $addResult = $account->addAccount($username,$password,$idUser);
            if($addResult === true){
                die(json_encode(array('code'=>0,'message'=>'Thành công')));
            }
            else{
                die(json_encode(array('code'=>1,'message'=>'Có lỗi xảy ra khi thêm user!')));
            }
        }
        else{
            die(json_encode(array('code'=>2,'message'=>'Thất Bại')));
        }
    }
?>