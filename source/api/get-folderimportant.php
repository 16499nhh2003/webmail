<?php
header('Content-Type: application/json; charset=utf-8');
    $method = $_SERVER['REQUEST_METHOD'];
    if($method === 'GET')
        {
            require_once ('../controller/emailfoldercontroller.php');
            $important = new EmailFolderController();
            // $important = $important->getAllFoderImportant();
            if(count($userResult) === 0 ){
                die(json_encode(array('code'=>0,"success"=>false)));
            }
            else{
                die(json_encode(array('code'=>1,"success"=>true)));
            }
        }
?>