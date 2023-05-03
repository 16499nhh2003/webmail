<?php
    header('Content-Type: application/json; charset=utf-8');
    $method = $_SERVER['REQUEST_METHOD'];
    if($method !== 'POST'){
        die(json_encode(array('message'=>'API chỉ chấp nhận method POST')));
    }
    else{
        if(isset($_POST['idEmail']) && isset($_POST['idFolder'])){
            require_once ('../controller/emailfoldercontroller.php');
            $idEmail  = $_POST['idEmail'];
            $idFolder = $_POST['idFolder'];
            $emailImportant = new EmailFolderController();
            $addResult = $emailImportant->addFoderImportant($idEmail,$idFolder);
            if($addResult === true){
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