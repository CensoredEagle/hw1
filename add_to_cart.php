<?php
session_start();
if (!isset($_SESSION["shopping_cart"])) {
    $_SESSION["shopping_cart"] = array();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $name = $_POST['name'] ?? null;
    $price = $_POST['price'] ?? null;
    $quantity = $_POST['quantity'] ?? 1;
    if ($id && $name && $price) {
        $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
        if (!in_array($id, $item_array_id)) {
            $item_array = array(
                'item_id' => $id,
                'item_name' => $name,
                'item_price' => $price,
                'item_quantity' => $quantity,
            );
            array_push($_SESSION['shopping_cart'], $item_array);
        } else {

            foreach ($_SESSION["shopping_cart"] as &$item) {
                if ($item["item_id"] == $id) {
                    $item["item_quantity"] += $quantity;
                }
            }
        }
    }
}


header('Content-Type: application/json');
echo json_encode(["success" => true]);
