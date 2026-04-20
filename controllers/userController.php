<?php

function registerUser() {
    global $conn;

    $input = json_decode(file_get_contents("php://input"), true);

    if (!$input || !isset($input['name']) || !isset($input['email']) || !isset($input['password'])) {
        http_response_code(422);
        echo json_encode(["status"=>"error","message"=>"Invalid input"]);
        return;
    }

    $name = $input['name'];
    $email = $input['email'];
    $password = $input['password'];

    mysqli_query($conn, "INSERT INTO users (name,email,password) VALUES ('$name','$email','$password')");

    echo json_encode(["status"=>"success","message"=>"User registered"]);
}

function getUsers() {
    global $conn;

    $result = mysqli_query($conn, "SELECT * FROM users");
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

    echo json_encode(["status"=>"success","data"=>$data]);
}
?>