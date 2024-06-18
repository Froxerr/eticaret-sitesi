<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productId = $_POST["product_id"];
    $quantity = $_POST["quantity"];

    // Sepette bu ürün var mı kontrol edelim
    if (isset($_SESSION["cart"][$productId])) {
        // Ürünün adedini güncelleyelim
        $_SESSION["cart"][$productId]["quantity"] = $quantity;

        // Sepetin HTML içeriğini oluşturup geri döndürebiliriz
        $cartHtml = getCartContentHtml($_SESSION["cart"]);
        echo $cartHtml;
    } else {
        echo "Ürün sepetinizde bulunamadı.";
    }
} else {
    echo "Geçersiz istek.";
}

function getCartContentHtml($cart) {
    $cartHtml = "";
    foreach ($cart as $item) {
        $cartHtml .= "<div class='border-bottom mb-3'></div>";
        $cartHtml .= "<div class='row mb-3'>";
        $cartHtml .= "<div class='col-md-3'>";
        $cartHtml .= "<img src='../img/" . $item["img"] . "' alt='Ürün Resmi' class='img-fluid'>";
        $cartHtml .= "</div>";
        $cartHtml .= "<div class='col-md-9'>";
        $cartHtml .= "<h6 class='mb-1'>" . $item['name'] . "</h6>";
        $cartHtml .= "<p class='mb-1'>Ürün Fiyatı: <strong>" . $item['price'] . "₺</strong></p>";
        $cartHtml .= "<div class='input-group mb-2'>";
        $cartHtml .= "<input id='quantity_" . $item['id'] . "' type='number' class='form-control' value='" . $item['quantity'] . "' min='1'>";
        $cartHtml .= "<button class='btn btn-outline-secondary update-cart-btn' type='button' data-id='" . $item['id'] . "'>Güncelle</button>";
        $cartHtml .= "</div>";
        $cartHtml .= "<button class='btn btn-danger btn-sm remove-cart-btn' type='button' data-id='" . $item['id'] . "'>Sil</button>";
        $cartHtml .= "</div>";
        $cartHtml .= "</div>";
    }
    return $cartHtml;
}
?>
