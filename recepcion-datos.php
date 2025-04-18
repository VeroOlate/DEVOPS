<?php

header("Access-Control-Allow-Origin: *");

header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    http_response_code(200);
    exit;
}

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $input = json_decode(file_get_contents("php://input"), true);
    $username = $input['username'] ?? '';
    $password = $input['password'] ?? '';
    
    
    if (empty($username) || empty($password)) {
        http_response_code(400);
        echo json_encode([
            "status" => "error",
            "message" => "Faltan datos: nombre de usuario o contraseña vacíos."
        ]);
        exit;
    }   
    if (strlen($password) < 6) {
        http_response_code(400);
        echo json_encode([
            "status" => "error",
            "message" => "La contraseña debe tener al menos 6 caracteres."
        ]);
        exit;
    }    
    http_response_code(200);
    echo json_encode([
        "status" => "ok",
        "message" => "Datos recibidos correctamente."
    ]);
} else {
    
    http_response_code(405); 
    echo json_encode([
        "status" => "error",
        "message" => "Método no permitido."
    ]);
}
