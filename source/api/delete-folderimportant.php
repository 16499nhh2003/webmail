<?php
    header('Content-Type: application/json; charset=utf-8');
    $action = $_GET['create'];
    $method = $_SERVER['REQUEST_METHOD'];
    if ($action === "delete"){
        require_once ('../controller/emailfoldercontroller.php');
        $idEmail =  $_GET['id']+0;
        if($method === 'DELETE'){
            $emailImportant = new EmailFolderController();
            $emailImportant->deleteFoderImportant($idEmail);
            if ($emailImportant){
                die(json_encode(array('code'=>0,'message'=>'Xoa thanh cong')));
            }
            else{
                die(json_encode(array('code'=>1,'message'=>'Co loi xay ra khi xoa')));
            }
        }
    }
    else{
        die(json_encode(array('code'=>2,'message'=>'Chi dung method Delete')));
    }
?>