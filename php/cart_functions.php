<?php
if (!function_exists('getCartContentHtml')) {
    function getCartContentHtml($cart) {
        $cartHtml = "<div class='container px-3'>";
        $totalPrice = 0;
        
        foreach ($cart as $item) {
            $itemTotal = $item['price'] * $item['quantity'];
            $totalPrice += $itemTotal;
            
            $cartHtml .= "<div class='border-bottom mb-3'></div>";
            $cartHtml .= "<div class='row mb-3 align-items-center'>";
            $cartHtml .= "<div class='col-4'>";
            $cartHtml .= "<img src='../img/" . $item["img"] . "' alt='Ürün Resmi' class='img-fluid rounded'>";
            $cartHtml .= "</div>";
            $cartHtml .= "<div class='col-8'>";
            $cartHtml .= "<h6 class='mb-2'>" . $item['name'] . "</h6>";
            $cartHtml .= "<p class='mb-2'>Ürün Fiyatı: <strong>" . $item['price'] . "₺</strong></p>";
            $cartHtml .= "<p class='mb-2'>Toplam: <strong>" . $itemTotal . "₺</strong></p>";
            $cartHtml .= "<div class='input-group input-group-sm mb-2' style='max-width: 200px;'>";
            $cartHtml .= "<input id='quantity_" . $item['id'] . "' type='number' class='form-control' value='" . $item['quantity'] . "' min='1'>";
            $cartHtml .= "<button class='btn btn-outline-secondary update-cart-btn' type='button' data-id='" . $item['id'] . "'>Güncelle</button>";
            $cartHtml .= "</div>";
            $cartHtml .= "<button class='btn btn-danger btn-sm remove-cart-btn' type='button' data-id='" . $item['id'] . "'>Sil</button>";
            $cartHtml .= "</div>";
            $cartHtml .= "</div>";
        }
        
        if (!empty($cart)) {
            $cartHtml .= "<div class='border-top pt-3 mt-3 sticky-bottom bg-white'>";
            $cartHtml .= "<h5 class='mb-3'>Sepet Toplamı: <strong>" . $totalPrice . "₺</strong></h5>";
            $cartHtml .= "<div class='d-grid gap-2'>";
            $cartHtml .= "<a href='sepetim.php' class='btn btn-primary'>Sepetime Git</a>";
            $cartHtml .= "<a href='odeme.php' class='btn btn-success'>Ödemeye Geç</a>";
            $cartHtml .= "</div>";
            $cartHtml .= "</div>";
        }
        
        $cartHtml .= "</div>";
        return $cartHtml;
    }
}
?> 