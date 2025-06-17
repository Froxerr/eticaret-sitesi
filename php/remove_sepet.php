<?php
session_start();
include('baglan.php');
if (!function_exists('getCartContentHtml')) {
    require_once('cart_functions.php');
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["product_id"])) {
    $productId = $_POST["product_id"];

    if (isset($_SESSION["cart"][$productId])) {
        unset($_SESSION["cart"][$productId]);
    }

    if (empty($_SESSION["cart"])) {
        echo "<p class='container' id='cartContent'>Sepet Boş</p>";
    } else {
        echo "<div class='container' id='cartContent'>";
        echo getCartContentHtml($_SESSION["cart"]);
        echo "</div>";
    }
}
?>
