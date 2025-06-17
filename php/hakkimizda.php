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
    <link rel="stylesheet" href="../css/hakkimizda.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Junge&family=Crimson+Text:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Lora:ital,wght@0,400..700;1,400..700&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

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

<!-- HAKKİMİZDA GİRİŞ BAŞLANGIÇ -->
    <div class="container pt-5">
        <div class="row">
            <div class="col-md-12 position-relative">
                <img src="../img/hakkimizda_bg.jpg" alt="" class="img-fluid rounded mx-auto d-block">
            </div>
        </div>
    </div>
<!-- HAKKİMİZDA GİRİŞ BİTİŞ -->

<!-- HAKKİMİZDA BAŞLANGIÇ -->
<div class="container pt-5 pb-5">
        <div class="row">
            <div class="col-md-6 position-relative">
                <div class="hakimizda">
                    <h1 class="h1-hakkimizda">HAKKIMIZDA</h1>

                    <h1 class="h1-hakkimizda-iddali">Tüm Dünyanın</h1>
                    <h1 class="h1-hakkimizda-iddali1">E-Ticarete Bakışını</h1>
                    <h1 class="h1-hakkimizda-iddali2">Değiştiriyoruz</h1>

                    <p class="p-hakkimizda">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                </div>
            </div>
            <div class="col-md-6">
                <img id="myGif" class="mygif img-fluid rounded mx-auto d-block" src="../img/ruj.gif" alt="GIF">
            </div>
        </div>
    </div>
<!-- HAKKİMİZDA BİTİŞ -->

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
    <script src="../js/script5.js"></script>
    <script src="../js/script6.js"></script>
    <script src="../js/script11.js"></script>

</body>
</html>
