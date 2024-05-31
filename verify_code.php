<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['code'])) {
        $code = $_POST['code'];

        // Check if the code exists in the database
        $sql = "SELECT * FROM codes WHERE code = '$code'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row['verified'] == FALSE) {
                // Code is valid and not yet used
                $update_sql = "UPDATE codes SET verified = TRUE WHERE code = '$code'";
                $conn->query($update_sql);
                echo json_encode(['status' => 'valid', 'product_id' => $row['product_id']]);
            } else {
                // Code is valid but already used
                echo json_encode(['status' => 'used']);
            }
        } else {
            // Code does not exist in the database
            echo json_encode(['status' => 'invalid']);
        }
    } else {
        echo json_encode(['error' => 'Code not provided']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}

$conn->close();
?>
