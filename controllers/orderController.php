<?php

function createOrder() {
    global $conn;

    $input = json_decode(file_get_contents("php://input"), true);

    if (!$input || !isset($input['user_id']) || !isset($input['product_id']) || !isset($input['quantity'])) {
        http_response_code(422);
        echo json_encode(["status"=>"error","message"=>"Invalid input"]);
        return;
    }

    $user_id = $input['user_id'];
    $product_id = $input['product_id'];
    $quantity = $input['quantity'];

    mysqli_query($conn, "INSERT INTO orders (user_id,product_id,quantity) VALUES ('$user_id','$product_id','$quantity')");

    echo json_encode(["status"=>"success","message"=>"Order placed"]);
}

function getOrders() {
    global $conn;

    $result = mysqli_query($conn, "SELECT * FROM orders");
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

    echo json_encode(["status"=>"success","data"=>$data]);
}
?>