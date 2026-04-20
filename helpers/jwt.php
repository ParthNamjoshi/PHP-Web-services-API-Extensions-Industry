<?php

function generateToken() {
    return base64_encode("my_secret_token");
}

function verifyToken($token) {
    return $token === base64_encode("my_secret_token");
}

?>