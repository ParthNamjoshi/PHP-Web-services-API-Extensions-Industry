<?php

header("Content-Type: application/json");

include("config/db.php");
include("controllers/productController.php");
include_once("helpers/jwt.php");       
include_once("middleware/auth.php");
include("controllers/userController.php");
include("controllers/orderController.php");

$request = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['REQUEST_URI'];

$path = str_replace("/assessments/Web_services_API_Extensions", "", $path);

// LOGIN ROUTE
if ($path == "/login" && $request == "POST") {
    echo json_encode([
        "token" => generateToken()
    ]);
}

// ALL ROUTES
elseif ($path == "/products" && $request == "GET") {
    getProducts();
}
elseif ($path == "/products" && $request == "POST") {
    checkAuth();
    addProduct();
}
elseif (preg_match("/\/products\/(\d+)/", $path, $matches) && $request == "PUT") {
    checkAuth();
    updateProduct($matches[1]);
}
elseif (preg_match("/\/products\/(\d+)/", $path, $matches) && $request == "DELETE") {
    checkAuth();
    deleteProduct($matches[1]);
}

// USER ROUTES
elseif ($path == "/users" && $request == "POST") {
    registerUser();
}
elseif ($path == "/users" && $request == "GET") {
    checkAuth();
    getUsers();
}

// ORDER ROUTES
elseif ($path == "/orders" && $request == "POST") {
    checkAuth();
    createOrder();
}
elseif ($path == "/orders" && $request == "GET") {
    checkAuth();
    getOrders();
}

// FINAL ELSE
else {
    http_response_code(404);
    echo json_encode(["message" => "Route not found"]);
}
?>