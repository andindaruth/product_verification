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
    if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
        $product_id = $_POST['product_id'];
        $quantity = intval($_POST['quantity']);
        $codes = [];

        for ($i = 0; $i < $quantity; $i++) {
            $code = generateCode();
            $codes[] = "('$product_id', '$code', FALSE)";
        }

        $values = implode(', ', $codes);
        $sql = "INSERT INTO codes (product_id, code, verified) VALUES $values";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(['status' => 'success', 'message' => "$quantity codes generated and stored successfully."]);
        } else {
            echo json_encode(['error' => 'Error: ' . $conn->error]);
        }
    } else {
        echo json_encode(['error' => 'Product ID and quantity must be provided']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}

$conn->close();
?>
