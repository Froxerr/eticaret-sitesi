<?php session_start(); ?>
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
    <link rel="stylesheet" href="../css/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Junge&family=Crimson+Text:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Lora:ital,wght@0,400..700;1,400..700&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

</head>
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
                        <a class="nav-link ms-lg-5 menu_a" href="#koleksiyonlar">Koleksiyonlar</a>
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
                <a href="#baslangic" style="text-decoration: none;"><span class="navbar-text mx-auto h5 mb-0 menu_baslik">ARAL</span></a>
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
            require_once('cart_functions.php');
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
<!-- MENU BİTİŞ -->

<!-- KULLANICI MODALI -->
 <!-- Modal -->
<div class="modal fade" id="userInfoModal" tabindex="-1" aria-labelledby="userInfoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body text-center">
        <h5>Kullanıcı Adınız: <?php echo $_SESSION['username']?> <span>&#x2728;</span></h5>
        <h5>Üyeliğiniz: <?php echo $_SESSION['uyelik']?> <span>&#x2605;</span></h5>
        <?php 
        if((isset($_SESSION['uyelik'])) && ($_SESSION['uyelik'] ==  "Yönetici") || ($_SESSION['uyelik'] ==  "Admin"))
        {
            echo "<a href='panel.php' style='text-decoration: none;'> <button type='button' class='btn btn-dark'>Panel'e Git</button> </a>";
        }
        ?>
        
        <button id="exitButton" class="btn btn-danger">Çıkış Yap</button>
      </div>
    </div>
  </div>
</div>



<!-- BAŞLANGIÇ GİRİŞ -->
    <div class="container-fluid pt-5" id="baslangic">
        <div class="row bg_bg pt-3">
            <div class="col-md-6">
                <h1 class="h1_yeniurun fade-in delay-1">YENİ ÜRÜN</h1>
                <h1 class="h1_metalikler fade-in delay-2">Metalikler</h1>
                <h1 class="h1_parlasin fade-in delay-3">Parlasın</h1>
                <p class="p_baslangic fade-in delay-4">Ciltle bütünleşen hafif dokulu,<br>
                    kadifemsi, parlak bitişli yeni göz farı<br>
                    paletlerimizi inceleyin
                </p>
                <a href="satis.php" style="text-decoration: none;"><button class="custom-button-baslangic fade-in delay-5">Satın Al</button></a>
            </div>
            <div class="col-md-6 pt-3">
                <img src="../img/bg-photo.png" alt="arka-plan-kisi" class="slide-in delay-4 img-fluid bg-photo">
            </div>
        </div>
    </div>
<!-- BAŞLANGIÇ BİTİŞ -->

<!-- ÜRÜNLER GİRİŞ -->
    <div class="container-fluid pt-5">
        <div class="row pt-5">
            <div class="col-md-12 justify-content-center align-items-center">
                <h1 class="text-center h1_urunler">Ürünler</h1>
            </div>
        </div>
        <div class="row pt-5">
            <div id="carouselExampleRide" class="carousel carousel-dark slide" data-bs-ride="true">
                <div class="carousel-inner">
                    <div class="carousel-item active card-wrapper-wrap text-center">
                        <div class="card-wrapper">
                        <a href="satis_hakkinda.php?urun_id=1" class="card_a">
                            <div class="card">
                                <div class="image-wrapper">
                                <img src="../img/card1.png"  alt="...">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Retinol Night Serum</h5>
                                    <p class="card-text card_header">140,00₺</p>
                                </div>
                            </div>
                        </a>
                        <a href="satis_hakkinda.php?urun_id=2" class="card_a">
                            <div class="card">
                            <div class="image-wrapper">
                                <img src="../img/card2.png"  alt="...">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Witch Hazel Toner</h5>
                                    <p class="card-text card_header">90,00₺</p>

                                </div>
                            </div>
                            </a>
                            <a href="satis_hakkinda.php?urun_id=3" class="card_a">
                            <div class="card">
                            <div class="image-wrapper">
                                <img src="../img/card3.png"  alt="...">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Vitamin C Face Cleanser</h5>
                                    <p class="card-text card_header">58,00₺</p>

                                </div>
                            </div>
                            </a>
                            <a href="satis_hakkinda.php?urun_id=4" class="card_a">
                            <div class="card">
                            <div class="image-wrapper">
                                <img src="../img/card4.png"  alt="...">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Makeup Primer Spray</h5>
                                    <p class="card-text card_header">70,00₺</p>

                                </div>
                            </div>
                            </a>
                        </div>
                    </div>
                    <div class="carousel-item card-wrapper-wrap text-center">
                        <div class="card-wrapper">
                        <a href="satis_hakkinda.php?urun_id=5" class="card_a">
                            <div class="card">
                            <div class="image-wrapper">
                                <img src="../img/card5.png"  alt="...">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">EyeShadow Brush</h5>
                                    <p class="card-text card_header">180,00₺</p>

                                </div>
                            </div>
                            </a>
                            <a href="satis_hakkinda.php?urun_id=6" class="card_a">
                            <div class="card">
                            <div class="image-wrapper">
                                <img src="../img/card6.png"  alt="...">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Lipsticks</h5>
                                    <p class="card-text card_header">300,00₺</p>

                                </div>
                            </div>
                            </a>
                            <a href="satis_hakkinda.php?urun_id=7" class="card_a">
                            <div class="card">
                            <div class="image-wrapper">
                                <img src="../img/card7.png"  alt="...">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Lipgloss</h5>
                                    <p class="card-text card_header">95,00₺</p>

                                </div>
                            </div>
                            </a>
                            <a href="satis_hakkinda.php?urun_id=8" class="card_a">
                            <div class="card">
                            <div class="image-wrapper">
                                <img src="../img/card8.png"  alt="...">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Black and Pink Lipstick</h5>
                                    <p class="card-text card_header">400,00₺</p>

                                </div>
                            </div>
                            </a>
                        </div>
                    </div>
                    <div class="carousel-item card-wrapper-wrap text-center">
                        <div class="card-wrapper">
                        <a href="satis_hakkinda.php?urun_id=9" class="card_a">
                            <div class="card">
                            <div class="image-wrapper">
                                <img src="../img/card9.png"  alt="...">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Lancome Lipstick</h5>
                                    <p class="card-text card_header">380,00₺</p>

                                </div>
                            </div>
                            </a>
                            <a href="satis_hakkinda.php?urun_id=10" class="card_a">
                            <div class="card">
                            <div class="image-wrapper">
                                <img src="../img/card10.png"  alt="...">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Estee Lauder</h5>
                                    <p class="card-text card_header">350,00₺</p>

                                </div>
                            </div>
                            </a>
                            <a href="satis_hakkinda.php?urun_id=11" class="card_a">
                            <div class="card">
                            <div class="image-wrapper">
                                <img src="../img/card11.png"  alt="...">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Palet</h5>
                                    <p class="card-text card_header">340,00₺</p>

                                </div>
                            </div>
                            </a>
                            <a href="satis_hakkinda.php?urun_id=12" class="card_a">
                            <div class="card">
                            <div class="image-wrapper">
                                <img src="../img/card12.png"  alt="...">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">NARS</h5>
                                    <p class="card-text card_header">140,00₺</p>

                                </div>
                            </div>
                            </a>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
<!-- ÜRÜNLER BİTİŞ -->



<!-- KOLEKSİYONLAR GİRİŞ -->

<div class="container-fluid pt-5" id="koleksiyonlar">
        <div class="row pt-5">
            <div class="col-md-12 justify-content-center align-items-center">
                <h1 class="text-center h1_urunler">Koleksiyonlar</h1>
            </div>
        </div>
        <div class="row pt-5">
            <div class="col-md-4 position-relative">
                <h1 class="position-absolute top-50 start-50 translate-middle h1_koleksiyon">Lipsticks</h1>
                <p class="position-absolute top-50 start-50 translate-middle p_koleksiyon">Koleksiyon Ürünleri</p>
                <img src="../img/koleksiyon_1.png" alt="" class="img-fluid rounded mx-auto d-block">
                
            </div>
            <div class="col-md-4 position-relative">
                <h1 class="position-absolute top-50 start-50 translate-middle h1_koleksiyon">Eyeliner</h1>
                <p class="position-absolute top-50 start-50 translate-middle p_koleksiyon">Koleksiyon Ürünleri</p>
                <img src="../img/koleksiyon_2.png" alt="" class="img-fluid rounded mx-auto d-block">
            </div>
            <div class="col-md-4 position-relative">
                <h1 class="position-absolute top-50 start-50 translate-middle h1_koleksiyon">Eye Shadow</h1>
                <p class="position-absolute top-50 start-50 translate-middle p_koleksiyon">Koleksiyon Ürünleri</p>
                <img src="../img/koleksiyon_3.png" alt="" class="img-fluid rounded mx-auto d-block">
            </div>
        </div>
    </div>

<!-- KOLEKSİYONLAR BİTİŞ -->


<!-- FOOTER GİRİŞ -->
<footer class="footer mt-5">
    <div class="container pt-5">
        <div class="row">
            <!-- Contact Information -->
            <div class="col-md-4">
                <h5>İletişim Bilgileri</h5>
                <p><i class="fas fa-map-marker-alt"></i> Adres: Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum </p>
                <p><i class="fas fa-phone-alt"></i> Telefon: +90 123 456 7890</p>
                <p><i class="fas fa-envelope"></i> Email: loremipsum@gmail.com</p>
            </div>
            <!-- Quick Links -->
            <div class="col-md-4">
                <h5>Hızlı Linkler</h5>
                <ul class="list-unstyled">
                    <li><a href="hakkimizda.php">Hakkımızda</a></li>
                    <li><a href="satis.php">Hizmetler</a></li>
                    <li><a href="iletisim.php">İletişim</a></li>
                    <li><a href="sss.php">Sıkça Sorulan Sorular</a></li>
                </ul>
            </div>
            <!-- Social Media Links -->
            <div class="col-md-4">
                <h5>Sosyal Medya</h5>
                <div class="social-icons">
                    <a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
        <div class="text-center mt-3">
            <p>&copy; 2024 ARAL. Tüm Hakları Saklıdır.</p>
        </div>
    </div>
</footer>
<!-- FOOTER BİTİŞ -->


    <!-- KİŞİSEL JAVASCRIPT -->
    <script src="../js/script.js"></script>
    <script src="../js/script2.js"></script>
    <script src="../js/script3.js"></script>
    <script src="../js/script11.js"></script>
</body>
</html>
