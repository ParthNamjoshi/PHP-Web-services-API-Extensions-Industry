<?php
include_once("helpers/jwt.php");

function checkAuth() {
    $headers = getallheaders();

    if (!isset($headers['Authorization'])) {
        http_response_code(401);
        echo json_encode(["message" => "Token required"]);
        exit;
    }

    $token = str_replace("Bearer ", "", $headers['Authorization']);

    if (!verifyToken($token)) {
        http_response_code(401);
        echo json_encode(["message" => "Invalid token"]);
        exit;
    }
}
?>