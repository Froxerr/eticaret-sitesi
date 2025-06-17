<?php
session_start();
include('baglan.php');
if (!function_exists('getCartContentHtml')) {
    require_once('cart_functions.php');
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["product_id"]) && isset($_POST["quantity"])) {
    $productId = $_POST["product_id"];
    $quantity = $_POST["quantity"];

    if (isset($_SESSION["cart"][$productId])) {
        $_SESSION["cart"][$productId]["quantity"] = $quantity;
    }

    if (empty($_SESSION["cart"])) {
        echo "<div class='d-flex justify-content-center align-items-center h-100'><p class='text-center'>Sepet Boş</p></div>";
    } else {
        echo getCartContentHtml($_SESSION["cart"]);
    }
} else {
    echo "Geçersiz istek.";
}
?>
