<?php
    header('Content-Type: application/json') ;
    $method = $_SERVER['REQUEST_METHOD'];
    if($method !== 'POST'){
        die(json_encode(array('message'=>'API chỉ chấp nhận method POST')));
    }
    else{
        $raw = file_get_contents('php://input') ;
        $json = json_decode($raw) ;
        $_POST['fullname'] = $json->fullname;
        $_POST['dob'] = $json->dob;
        $_POST['gioitinh'] = $json->gioitinh;
        $_POST['email'] = $json->email;

        if(isset($_POST['fullname']) && isset($_POST['dob']) &&  isset($_POST['gioitinh'])  && isset($_POST['email'])){
            $fullname = $_POST['fullname'];
            $dob = $_POST['dob'];
            $gioitinh = $_POST['gioitinh'];
            $email = $_POST['email'];
            require_once ('../controller/usercontroller.php');
            $user = new UserController();
            $addResult = $user->addUser($fullname,$dob,$gioitinh,$email);
            if($addResult != -1){
                die(json_encode(array('code'=>0,'message'=>'Thành công','data'=>$addResult)));
            }
            else{
                die(json_encode(array('code'=>1,'message'=>'Lỗi xảy ra khi thêm người dùng')));
            }
        }
        else{
            die(json_encode(array('code'=>2,'message'=>'Thất bại')));
        }
    }
?>