<?php 
session_start();
try {
include('baglan.php');
$urun_id = $_GET["urun_id"];
$sql = "SELECT urunler.urun_adi, urunler.urun_fiyati, urun_detaylari.id, urunler.urun_alt_kategori
            FROM urunler
            INNER JOIN urun_detaylari ON urunler.urun_adi = urun_detaylari.urun_ismi
                                       AND urunler.urun_fiyati = urun_detaylari.urun_fiyati
            WHERE urunler.id = :urun_id";
$stmt = $DBcon->prepare($sql);
$stmt->bindParam(':urun_id', $urun_id, PDO::PARAM_INT);
$stmt->execute();

$rowCount = $stmt->rowCount();
    
    if ($rowCount > 0) {
        // Eşleşen ürün IDsini alıp ekrana yazdırma
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

    } else {
        header("Location: satis.php");
        exit;
    }
} catch(PDOException $e) {
    echo "Hata oluştu: " . $e->getMessage();
}

$sorgu = $DBcon->prepare("SELECT id, urun_ismi, urun_stokkod, urun_ana_img, urun_yan_img_1, urun_yan_img_2, urun_fiyati, urun_aciklama, urun_ve_iade_politikasi_aciklama, gonderim_bilgisi_aciklama
                     FROM urun_detaylari
                     WHERE id = :urun_id");
$sorgu->bindParam(':urun_id', $result["id"], PDO::PARAM_INT); // Parametreyi bağla
$sorgu->execute(); // Sorguyu çalıştır

// Sonucu al ve dizi olarak sakla
$result1 = $sorgu->fetch(PDO::FETCH_ASSOC);
if($result1)
{
$urun_detay_id =$result1['id'];
$urun_ismi=$result1['urun_ismi'];
$urun_stokkod=$result1['urun_stokkod'];
$urun_ana_img=$result1['urun_ana_img'];
$urun_yan_img_1=$result1['urun_yan_img_1'];
$urun_yan_img_2=$result1['urun_yan_img_2'];
$urun_fiyati=$result1['urun_fiyati'];
$urun_aciklama=$result1['urun_aciklama'];
$urun_ve_iade_politikasi_aciklama=$result1['urun_ve_iade_politikasi_aciklama'];
$gonderim_bilgisi_aciklama=$result1['gonderim_bilgisi_aciklama'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARAL</title>
    <link rel="icon" href="../img/favicon.ico" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- KİŞİSEL -->
    <link rel="stylesheet" href="../css/satis_hakkinda.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Junge&family=Crimson+Text:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Lora:ital,wght@0,400..700;1,400..700&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <script>
        $(document).ready(function() {
            // Sepete ürün ekleme işlemi
            $("#addToCartForm").on("submit", function(e) {
                e.preventDefault();
                
                $.ajax({
                    url: "sepet_ekle.php",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        // Sepet içeriğini güncelle
                        $(".offcanvas-body").html(response);
                        // Diğer sayfalara bildir
                        localStorage.setItem("cartContent", response);
                        localStorage.setItem("cartUpdateTime", new Date().getTime());
                        // Custom event tetikle
                        $(document).trigger("cart:updated", [response]);
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error:", error);
                    }
                });
            });
        });
    </script>
</head>
<body>
<!-- MENU BAŞLANGIÇ -->
    <nav class="navbar navbar-expand-lg bg-light bg-gradient ">
        <div class="container-fluid pt-3 pb-3">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link ms-lg-5 menu_a" href="index.php#koleksiyonlar">Koleksiyonlar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link ms-lg-5 menu_a" href="sss.php">SSS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link ms-lg-5 menu_a" href="iletisim.php">İletişim</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link ms-lg-5 menu_a" href="satis.php">Ürünler</a>
                    </li>
                </ul>
                <a href="index.php#baslangic" style="text-decoration: none;"><span class="navbar-text mx-auto h5 mb-0 menu_baslik">ARAL</span></a>
                <form class="d-flex ms-auto position-relative" action="details.php" method="post">
                    <div class="position-relative">
                        <input class="form-control custom-search-input" type="search" placeholder="Ara.." aria-label="Search" name="search" id="search" autocomplete="off">
                        <button class="search-button" type="submit" name="submit">
                            <i class="fas fa-search search-icon"></i>
                        </button>
                        <div class="scrollable-list position-absolute">
                            <ul class="list-group list-group-flush" id="show-list">
                                <li class="list-group-item empty-message text-muted text-center">Liste boş.</li>
                            </ul>
                        </div>
                    </div>
                    <?php 
                        if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
                            // Kullanıcı adı oturumda varsa
                            $username = $_SESSION['username'];
                            echo '
                            <button class="btn btn-outline-dark me-3 ms-4" id="openModalButton" type="button"> 
                                <i class="fas fa-circle-user custom-icon me-2"></i> ' . htmlspecialchars($username) . '
                            </button>
                            <button class="cart-button pe-4">
                                <i class="fas fa-shopping-cart cart-icon"></i>
                            </button>';
                        } else {
                            // Kullanıcı adı oturumda yoksa
                            echo '
                                <a href="giris.php">
                                    <button class="btn btn-outline-dark me-3 ms-4" type="button"> 
                                        <i class="fas fa-circle-user custom-icon me-2"></i> Giriş
                                    </button>
                                </a>
                                <button class="cart-button pe-4">
                                    <i class="fas fa-shopping-cart cart-icon"></i>
                                </button>
                                ';
                        }
                    ?>
                </form>
                
            </div>
        </div>
    </nav>
                        <div class="offcanvas offcanvas-end" tabindex="-1" id="cartSidebar" aria-labelledby="cartSidebarLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="cartSidebarLabel">Sepetim</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body d-flex ">
                                <?php
                                include('cart_functions.php');
                                    if (isset($_SESSION["cart"]) && !empty($_SESSION["cart"])) {
                                    echo "<div class='container' id='cartContent'>";
                                        echo getCartContentHtml($_SESSION["cart"]);
                                    echo "</div>";
                                    } else {
                                    // Sepet boşsa mesaj göster
                                    echo "<p class='container' id='cartContent'>Sepet Boş</p>";
                                    }
                ?>
                            </div>
                        </div>
                    </div>
<!-- MENU BİTİŞ -->

<!-- ÜRÜN AÇIKLAMA GİRİŞ -->
<div class="pt-5">
<div class="container mt-5 pt-5">
    <div class="breadcrumb-custom">
        <div class="breadcrumb-nav">
            <p class="urun_anasayfa"><b>Ana Sayfa / </b> <?=$result["urun_alt_kategori"]?></p>
        </div>
    </div>
                    <?php
                    if ( $result1){
                    ?> 
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="product-image-container">
                                <img src="../img/<?=$urun_ana_img?>" alt="Ürün Resmi" class="product-image" id="productImage">
                            </div>
                            <div class="thumbnail-container">
                            <img src="../img/<?=$urun_ana_img?>" alt="Küçük Resim 1" class="thumbnail" data-image="../img/<?=$urun_ana_img?>">
                                <?php 
                                if($urun_yan_img_1 == "yok")
                                {
                                    // boş
                                }
                                else
                                {
                                    echo '<img src="../img/'.$urun_yan_img_1.'" alt="Küçük Resim 2" class="thumbnail" data-image="../img/'.$urun_yan_img_1.'">';
                                }
                                if($urun_yan_img_2 == "yok")
                                {
                                    // boş
                                }
                                else
                                {
                                    echo '<img src="../img/'.$urun_yan_img_2.'" alt="Küçük Resim 3" class="thumbnail" data-image="../img/'.$urun_yan_img_2.'">';
                                }
                                
                                
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h2 class="urun_adi"><?=$urun_ismi?></h2>
                            <p class="urun_stokkodu">Stok Kodu: <?=$urun_stokkod?></p>
                            <p class="urun_ucret"><?=$urun_fiyati?>,00₺</p>
                            <p class="urun_adet">Adet</p>
                            <form id="addToCartForm">
                                <input type="hidden" name="product_id" value="<?=$urun_detay_id?>">
                                <input type="number" name="quantity" id="quantityInput" value="1" class="form-control number-input" style="width: 70px;">
                                <button type="submit" class="btn btn-primary mt-5 add-to-cart">Sepete Ekle</button>
                            </form>
                            <div class="row mt-5">
                                <div class="col-md-12 mt-2">
                                    <div class="box">
                                    <div class="box-header">
                                        ÜRÜN VE PARA İADE POLİTİKASI
                                        <button class="expand-button" id="expandButton">+</button>
                                    </div>
                                    </div>
                                    <div class="content" id="boxContent">
                                        <p class="p_sss">Cevap: <?=$urun_ve_iade_politikasi_aciklama?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box">
                                    <div class="box-header">
                                        GÖNDERİM BİLGİSİ
                                        <button class="expand-button" id="expandButton">+</button>
                                    </div>
                                    </div>
                                    <div class="content" id="boxContent">
                                        <p class="p_sss">Cevap: <?=$gonderim_bilgisi_aciklama?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-12">
                            <h3 class="urun_aciklama_basligi">Ürün Açıklaması</h3>
                            <p class="urun_aciklamasi"><?=$urun_aciklama?></p>
                        </div>
                    </div>
                   
                    <?php 
                    }
                    ?>
    
</div>
</div>
<!-- ÜRÜN AÇIKLAMA BİTİŞ -->


    <!-- KİŞİSEL JAVASCRIPT -->
    <script src="../js/script.js"></script>
    <script src="../js/script2.js"></script>
    <script src="../js/script3.js"></script>
    <script src="../js/script5.js"></script>
    <script src="../js/script8.js"></script>
    <script src="../js/script11.js"></script>
</body>
</html>
