<?php
header('Content-Type: application/json; charset=utf-8');
$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'PUT'){
        require_once('../controller/mailcontroller.php');
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        if (!$data) {
            die(json_encode(array("code"=>0,"message" => "Invalid JSON")));
        } else {
            $id = $data->id;
            $res = (new MailController())->updateRead($id);
            if ($res > 0) {
                die(json_encode(array("code"=>1,"message" => "Thay doi thanh cong")));
            } 
            else {
                die(json_encode(array("code"=>2,"message" => "Thay doi that bai")));
            }
        }
}
