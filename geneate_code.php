<?php
require 'db.php';

function generateCode($length = 10) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $code = generateCode();

    $sql = "INSERT INTO codes (product_id, code) VALUES ('$product_id', '$code')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['code' => $code]);
    } else {
        echo json_encode(['error' => 'Error: ' . $conn->error]);
    }
}

$conn->close();
?>
