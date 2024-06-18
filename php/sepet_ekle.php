<?php
session_start();
include('baglan.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productId = $_POST["product_id"];
    $adet = $_POST["quantity"];

    $sorgu = $DBcon->prepare("SELECT id, urun_ismi, urun_fiyati, urun_ana_img FROM urun_detaylari WHERE id = :productId");
    $sorgu->bindParam(':productId', $productId, PDO::PARAM_INT);
    $sorgu->execute();
    $result1 = $sorgu->fetch(PDO::FETCH_ASSOC);

    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = [];
    }

    $product = [
        "id" => $productId,
        "name" => $result1["urun_ismi"],
        "price" => $result1["urun_fiyati"],
        "img" => $result1["urun_ana_img"],
        "quantity" => $adet
    ];

    $_SESSION["cart"][$productId] = $product;

    if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
        // Kullanıcı adı oturumda varsa
        $currentDateTime = date("Y-m-d H:i:s");
        function getIPAddress() {  
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
             return $ip;  
        }  
        $kuladi = $_SESSION['username'];
        $ip = getIPAddress();  
        $stmt = $DBcon->prepare("INSERT INTO sepet_kontrol (sepet_mail,sepet_urun,sepet_tarih,sepet_adres,sepet_ucret) VALUES(:sepet_mail, :sepet_urun, :sepet_tarih, :sepet_adres, :sepet_ucret)");
        $stmt->bindparam(':sepet_mail',$kuladi);
        $stmt->bindparam(':sepet_urun',$result1["urun_ismi"]);
        $stmt->bindparam(':sepet_tarih',$currentDateTime);
        $stmt->bindparam(':sepet_adres',$ip);
        $stmt->bindparam(':sepet_ucret',$result1["urun_fiyati"]);
        $stmt->execute();
    } 

    echo getCartContentHtml($_SESSION["cart"]);
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
