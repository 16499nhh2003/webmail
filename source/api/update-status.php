<?php
header('Content-Type: application/json; charset=utf-8');
$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'PUT'){
        require_once('../controller/usercontroller.php');
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        if (!$data) {
            die(json_encode(array("message" => "Invalid JSON")));
        } else {
            $id = $data->id;
            $fullname = $data->fullname;
            $dob = $data->dob;
            $gioitinh = $data->gioitinh;
            $email = $data->email;
            $update = new UserController();
            if ($update->update($id, $fullname, $dob, $gioitinh, $email)) {
                die(json_encode(array("message" =>true)));
            } else {
                die(json_encode(array("message" =>false)));
            }
        }
}
