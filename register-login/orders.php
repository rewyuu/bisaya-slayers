<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $orderData = json_decode(file_get_contents('php://input'), true);

    if (!isset($_SESSION["user"])) {
        echo json_encode(["success" => false, "message" => "User not logged in"]);
        exit;
    }

    $orderData['user'] = $_SESSION["user"];
    $orderData['status'] = 'pending';

    if (!isset($_SESSION["orders"])) {
        $_SESSION["orders"] = [];
    }

    $_SESSION["orders"][] = $orderData;

    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method"]);
}
?>
