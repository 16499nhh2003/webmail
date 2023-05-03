<?php
header('Content-Type: application/json; charset=utf-8');
$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'POST') {
    $raw = file_get_contents('php://input');
    $json = json_decode($raw);
    require_once('../controller/mailcontroller.php');
    $mail = new MailController();
    $data = array("success" => true, "data" => $mail->findMailByUserName($json->username));
    die(json_encode($data));
}
?>