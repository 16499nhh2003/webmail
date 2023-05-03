<?php
header('Content-Type: application/json; charset=utf-8');
    $method = $_SERVER['REQUEST_METHOD'];
    if($method === 'GET')
        {
            require_once ('../controller/mailcontroller.php');
            // var_dump($_GET);
            // exit();
            $mail = new MailController();
            // var_dump($mail->getMail($_GET['username']));
            $data = array("success"=>true,"data"=>$mail->getMail($_GET['username']));
            die(json_encode($data));
        }
?>