<?php
session_start();
include('baglan.php');
if (!function_exists('getCartContentHtml')) {
    require_once('cart_functions.php');
}

if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
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

    if (empty($_SESSION["cart"])) {
        echo "<p class='container' id='cartContent'>Sepet Boş</p>";
    } else {
        echo "<div class='container' id='cartContent'>";
        echo getCartContentHtml($_SESSION["cart"]);
        echo "</div>";
    }
}
?>
