<?php
header('Content-Type: application/json; charset=utf-8');
$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'PUT'){
        require_once('../controller/accountcontroller.php');
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        if (!$data) {
            die(json_encode(array("message" => "Invalid JSON")));
        } else {
            $username = $data->username;
            $passold = $data->passold;
            $passsNew = $data->passsNew;
            // echo $username,$passold,$passsNew;
            $update = new AccountController();
            if ($update->changePass($username, ($passold), ($passsNew))) {
                die(json_encode(array("message" =>true)));
            } else {
                die(json_encode(array("message" =>false)));
            }
        }
}
