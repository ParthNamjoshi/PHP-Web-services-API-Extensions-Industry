<?php

function getProducts() {
    global $conn;

    $result = mysqli_query($conn, "SELECT * FROM products");
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

    http_response_code(200);
    echo json_encode($data);
}

function addProduct() {
    global $conn;

    $input = json_decode(file_get_contents("php://input"), true);

    $name = $input['name'];
    $price = $input['price'];

    mysqli_query($conn, "INSERT INTO products (name, price) VALUES ('$name','$price')");

    http_response_code(201);
    echo json_encode(["message" => "Product added"]);
}

function updateProduct($id) {
    global $conn;

    $input = json_decode(file_get_contents("php://input"), true);

    $name = $input['name'];
    $price = $input['price'];

    mysqli_query($conn, "UPDATE products SET name='$name', price='$price' WHERE id=$id");

    echo json_encode(["message" => "Product updated"]);
}

function deleteProduct($id) {
    global $conn;

    mysqli_query($conn, "DELETE FROM products WHERE id=$id");

    echo json_encode(["message" => "Product deleted"]);
}
?>