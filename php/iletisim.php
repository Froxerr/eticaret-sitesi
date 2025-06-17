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
    <link rel="stylesheet" href="../css/iletisim.css">
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
                        <a class="nav-link ms-lg-5 menu_a" href="#">İletişim</a>
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
            if (!function_exists('getCartContentHtml')) {
                require_once('cart_functions.php');
            }
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

<!-- İLETİŞİM BAŞLANGIÇ -->
<div class="container pt-5 mt-5">
  <div class="row pt-5">
        <div class="col-md-6">
            <h1 class="mt-5">Yeni Markanızı</h1>
            <h1>Beraber Yaratalım</h1>
            <p class="iletisim_p">Herhangi bir reklam antlaşması için</p>
            <p class="iletisim_p1">formu doldurun veya bizi arayın.</p>
            <h1 class="iletisim_h1_hizmet">Hizmet Bölgeleri:</h1>
            <p class="iletisim_p2">İstanbul, İzmir, Ankara, Muğla, Antalya, Eskişehir</p>
            <p class="iletisim_p3">Lorem Ipsum is simply dummy text of the printing</p>
            <p class="iletisim_p3">loremipsum@gmail.com</p>
            <p class="iletisim_p3">+90 123 456 7890</p>
        </div>
        <div class="col-md-6">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
              <div class="row">
                  <div class="col-md-6">
                      <label for="ad" class="iletisim_label">Adı*</label>
                      <input type="text" id="ad" name="ad" class="form-control iletisim_input" required>
                      <div class="bottom-line"></div>
                  </div>
                  <div class="col-md-6">
                      <label for="soyad" class="iletisim_label">Soyadı*</label>
                      <input type="text" id="soyad" name="soyad" class="form-control iletisim_input" required>
                      <div class="bottom-line"></div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-6">
                      <label for="eposta" class="iletisim_label">E-posta*</label>
                      <input type="email" id="eposta" name="eposta" class="form-control iletisim_input" required>
                      <div class="bottom-line"></div>
                  </div>
                  <div class="col-md-6">
                      <label for="telefon" class="iletisim_label">Telefon*</label>
                      <input type="tel" id="telefon" name="telefon" class="form-control iletisim_input" required>
                      <div class="bottom-line"></div>
                  </div>
              </div>
              <div class="row">
                  <div class="col">
                      <label for="adres" class="iletisim_label">Adres*</label>
                      <input type="text" id="adres" name="adres" class="form-control iletisim_input" required>
                      <div class="bottom-line"></div>
                  </div>
              </div>
              <div class="row">
                  <div class="col">
                      <label for="konu" class="iletisim_label">Konu*</label>
                      <input type="text" id="konu" name="konu" class="form-control iletisim_input" required>
                      <div class="bottom-line"></div>
                  </div>
              </div>
              <div class="row">
                  <div class="col">
                      <label for="mesaj" class="iletisim_label">Uzun Mesajınız</label>
                      <textarea id="mesaj" name="mesaj" rows="5" class="form-control iletisim_input"></textarea>
                      <div class="bottom-line"></div>
                  </div>
              </div>
              <div class="row mt-3">
                  <div class="col">
                      <button type="submit" class="btn btn-dark">Gönder</button>
                  </div>
              </div>
          </form>
        </div>
  </div>
</div>
<!-- İLETİŞİM BİTİŞ -->




    <!-- KİŞİSEL JAVASCRIPT -->
    <script src="../js/script.js"></script>
    <script src="../js/script2.js"></script>
    <script src="../js/script3.js"></script>
    <script src="../js/script4.js"></script>
    <script src="../js/script11.js"></script>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include('baglan.php');
    $currentDateTime = date("Y-m-d H:i:s");

    $form_ad = $_POST['ad'];
    $form_soyad = $_POST['soyad'];
    $form_eposta = $_POST['eposta'];
    $form_telefon = $_POST['telefon'];
    $form_adres = $_POST['adres'];
    $form_konu = $_POST['konu'];
    $form_mesaj = $_POST['mesaj'];

    $sql = "INSERT INTO iletisim (adi, soyadi, eposta, telefon, adres, konu, mesaj, saat) VALUES (:ad, :soyad, :eposta, :telefon, :adres, :konu, :mesaj, :saat)";
    $stmt = $DBcon->prepare($sql);
    $stmt->bindParam(':ad', $form_ad);
    $stmt->bindParam(':soyad', $form_soyad);
    $stmt->bindParam(':eposta', $form_eposta);
    $stmt->bindParam(':telefon', $form_telefon);
    $stmt->bindParam(':adres', $form_adres);
    $stmt->bindParam(':konu', $form_konu);
    $stmt->bindParam(':mesaj', $form_mesaj);
    $stmt->bindParam(':saat', $currentDateTime);

    try {
        $stmt->execute();
        echo "<script>alert('Mesajınız başarıyla kaydedildi.');</script>";
    } catch(PDOException $e) {
        echo "<script>alert('Hata: " . $e->getMessage() . "');</script>";
    }
    
    // PDO bağlantısını kapat
    $DBcon = null;
}
?>
