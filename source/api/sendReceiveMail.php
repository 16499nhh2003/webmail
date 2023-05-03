<?php
    header('Content-Type: application/json; charset=utf-8');
    $method = $_SERVER['REQUEST_METHOD'];
    if($method !== 'POST'){
        die(json_encode(array('message'=>'API chỉ chấp nhận method POST')));
    }
    else{
        $raw = file_get_contents('php://input') ;
        $json = json_decode($raw) ;
        $_POST['chude'] = $json->chude;
        $_POST['noidung'] = $json->noidung;
        $_POST['nguoigui'] = $json->nguoigui;
        $_POST['thoigian'] = $json->thoigian;
        $_POST['starred'] = $json->starred;
        $_POST['read'] = $json->read;
        $_POST['idFolder'] = $json->idFolder;
        $_POST['username'] = $json->username;
        if(isset($_POST['chude']) && isset($_POST['noidung']) && isset($_POST['nguoigui']) &&isset($_POST['thoigian']) && isset($_POST['starred']) && isset($_POST['read']) &&isset($_POST['idFolder']) && isset($_POST['username'])){
            require_once ('../controller/mailcontroller.php');
            $mail = new MailController();
            $res = $mail->sendReceiveMail($_POST['chude'],$_POST['noidung'],$_POST['nguoigui'],$_POST['thoigian'],$_POST['starred'],$_POST['read'],$_POST['idFolder'],$_POST['username']);
            // var_dump($res);
            if($res !== -1){
                die(json_encode(array('code'=>0,'message'=>'Thành công')));
            }
            else{
                die(json_encode(array('code'=>1,'message'=>'Có lỗi xảy ra khi thêm!')));
            }
        }
        else{
            die(json_encode(array('code'=>2,'message'=>'Thất Bại')));
        }
    }
?>