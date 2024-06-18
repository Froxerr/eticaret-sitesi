<?php session_start(); include('baglan.php');?>
<?php
if (isset($_SESSION['eposta'])) 
{
    $_SESSION['uyelik'] = "";
    $eposta = $_SESSION['eposta'];
    include('baglan.php');

    $email = $_SESSION['eposta'];

    $sorgu = $DBcon->prepare("SELECT * FROM login WHERE eposta = :email");
    $sorgu->bindParam(':email', $email);
    $sorgu->execute();
    $cikti = $sorgu->fetch(PDO::FETCH_ASSOC);

    $_SESSION['uyelik'] = $cikti["uyelik"];
}
?>
<?php
if (isset($_GET['kategori'])) 
{
    $kategori = $_GET['kategori'];
    
    
    $query = $DBcon->prepare("SELECT * FROM urunler WHERE urun_alt_kategori = :kategori");
    $query->bindParam(':kategori', $kategori);
    $query->execute();

    $counter = 0;
    $rowCount = $query->rowCount();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AAA</title>
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
    <!-- noUiSlider CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.5.1/nouislider.min.css" rel="stylesheet">
    <!-- noUiSlider JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.5.1/nouislider.min.js"></script>
    <!-- KİŞİSEL -->
    <link rel="stylesheet" href="../css/satis.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Junge&family=Crimson+Text:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Lora:ital,wght@0,400..700;1,400..700&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

</head>
<style>.sidebar {padding: 20px;border-right: 1px solid #000;height: 840px;}
.aktif{color: #d8c89e;}
</style>
<body>
<!-- MENU BAŞLANGIÇ -->
    <nav class="navbar navbar-expand-lg bg-light bg-gradient">
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
                                    if (isset($_SESSION["cart"]) && !empty($_SESSION["cart"])) {
                                        echo "<div class='container' id='cartContent'>";
                                        echo getCartContentHtml($_SESSION["cart"]);
                                        echo "</div>";
                                    } else {
                                        // Sepet boşsa mesaj göster
                                        echo "<p class='container' id='cartContent'>Sepet Boş</p>";
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
        </div>
    </div>
<!-- MENU BİTİŞ -->
<!-- KULLANICI MODALI -->
 <!-- Modal -->
 <div class="modal fade" id="userInfoModal" tabindex="-1" aria-labelledby="userInfoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body text-center">
        <h5>Kullanıcı Adınız: <?php echo $_SESSION['username']?> <span>&#x2728;</span></h5>
        <h5>Üyeliğiniz: <?php echo $_SESSION['uyelik']?> <span>&#x2605;</span></h5>
        <button id="exitButton" class="btn btn-danger mt-3">Çıkış Yap</button>
      </div>
    </div>
  </div>
</div>







<!-- SATIŞ KISMI BAŞLANGIÇ -->
    <div class="container-fluid pt-5">
        <div class="row pt-5 ms-5">
            <div class="col-md-2 col-12 sidebar">
                <p class="satis_gecis_p">Ana Sayfa <big>&nbsp;&gt;&nbsp;</big> Makyaj <big>&nbsp;&gt;&nbsp;</big><?=$kategori?></p>
                <p class="satis_gecis_gozat">Göz At:</p>
                <div class="divider"></div>
                <ul class="list-unstyled">
                    <li><a href="satis.php" >Tüm Ürünler</a></li>
                    <li><a href="satis-Makyaj.php" class="aktif">Makyaj</a></li>
                    <li><a href="satis-CiltBakim.php">Cilt Bakımı</a></li>
                    <li><a href="satis-SacBakim.php" >Saç Bakımı</a></li>
                    <li><a href="satis-KisiselBakim.php">Kişisel Bakım</a></li>
                    <li><a href="satis-ParfumveDeodorant.php" >Parfüm ve Deodorant</a></li>
                </ul>
                <div class="mb-5"></div>

                <p class="satis_gecis_gozat">Kategoriler: </p>
                <div class="divider"></div>
                <ul class="list-unstyled" id="categoryList">
                    <li><a href="satis-Makyaj_kategori.php?kategori=Yüz Makyajı">Yüz Makyajı</a></li>
                    <li><a href="satis-Makyaj_kategori.php?kategori=Göz Makyajı">Göz Makyajı</a></li>
                    <li><a href="satis-Makyaj_kategori.php?kategori=Dudak Makyajı">Dudak Makyajı</a></li>
                    <li><a href="satis-Makyaj_kategori.php?kategori=Makyaj Fırçaları">Makyaj Fırçaları</a></li>
                    <li><a href="satis-Makyaj_kategori.php?kategori=Makyaj Aksesuarları">Makyaj Aksesuarları</a></li>
                </ul>
                <div class="mb-5"></div>


                <p class="satis_gecis_gozat">Filtrele:</p>
                <div class="divider"></div>
                <div class="price-label">
                    <span class="satis_gecis_fiyat">Fiyat</span>
                    <span id="toggleSlider">+</span>
                </div>
                    <div class="price-slider" id="price-slider"></div>
                    <input type="hidden" id="minValueInput" name="minValue">
                    <input type="hidden" id="maxValueInput" name="maxValue">
                    <div class="price-details">
                        <span id="minValue">20</span>,00 ₺ 
                        <span class="maxvalue-right">,00 ₺</span>
                        <span id="maxValue" class="maxvalue-right">220</span>

                    </div>
                <div class="divider"></div>
            </div>
            
            <div class="col-md-10 col-12">
                <h1 class="product-title"><?=$kategori?></h1>
                <p class="product-count" id="productCount"><?=$rowCount?> ürün</p>
                <?php
                    echo '<div class="row">';
                    if ( $query->rowCount() ){

                        foreach( $query as $row ){
                            $id=$row['id'];
                            $urun_adi=$row['urun_adi'];
                            $urun_fiyati=$row['urun_fiyati'];
                            $urun_resimi=$row['urun_resimi'];
                            if ($counter > 0 && $counter % 3 == 0) {
                                echo '</div><div class="row">';
                            }  
                    ?> 
                    
                        <div class="col-md-4 product">
                        <a class="a_satis" href="satis_hakkinda.php?urun_id=<?=$id?>">
                            <img src="../img/<?=$urun_resimi?>" alt="Ürün 1">
                            <p class="card-title"><?=$urun_adi?></p>
                            <p class="product-description"><?=$urun_fiyati?>,00 ₺</p>
                            </a>
                        </div>
                   
                    <?php 
                    }
                    $counter++;
                    } 
                    ?>
            </div>
        </div>
    </div>
<!-- SATIŞ KISMI BİTİŞ -->




    <!-- KİŞİSEL JAVASCRIPT -->
    <script src="../js/script.js"></script>
    <script src="../js/script2.js"></script>
    <script src="../js/script3.js"></script>
    <script src="../js/script7.js"></script>
    <script src="../js/script11.js"></script>
    <script src="../js/script13.js"></script>
</body>
</html>


