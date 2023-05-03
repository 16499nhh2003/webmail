<?php
header('Content-Type: application/json; charset=utf-8');
    $method = $_SERVER['REQUEST_METHOD'];
    if($method === 'GET')
        {
            require_once ('../controller/mailcontroller.php');
            $id = new MailController();
            $idFolder = $_GET['idFolder']+0;
            //var_dump($id->getMailByUserNameAndByType($_GET['username'],1));
            $data = array("success"=>true,"data"=>$id->getMailByUserNameAndByType($_GET['username'],$idFolder));
            die(json_encode($data));
        }
?>