<?php
$conn = mysqli_connect("localhost", "root", "", "smart_store");

if (!$conn) {
    die(json_encode(["message" => "Database connection failed"]));
}
?>