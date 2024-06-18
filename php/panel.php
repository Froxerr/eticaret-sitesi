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
<?php 

include('baglan.php');


$query = $DBcon->query("SELECT * FROM iletisim", PDO::FETCH_ASSOC);
$rowCount = $query->rowCount();

$query1 = $DBcon->query("SELECT * FROM login", PDO::FETCH_ASSOC);
$query2 = $DBcon->query("SELECT * FROM sepet_kontrol", PDO::FETCH_ASSOC);
?>

<?php 
try {
    $sql = "SELECT login_giris.giris_mail, login_giris.giris_saat, login_giris.giris_adres, login_cikis.cikis_saat, login_cikis.cikis_adres
            FROM login_giris 
            INNER JOIN login_cikis ON login_giris.giris_mail = login_cikis.cikis_mail
                                    AND login_giris.giris_sifre = login_cikis.cikis_sifre
                                    AND login_giris.benzersiz_anahtar = login_cikis.benzersiz_anahtar

";
    $stmt = $DBcon->prepare($sql);
    $stmt->execute();
    
    } catch(PDOException $e) {
        echo "Hata oluştu: " . $e->getMessage();
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

    <!-- KİŞİSEL -->
    <link rel="stylesheet" href="../css/panel.css">
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



<!-- PANEL GİRİŞ -->
<div class="pt-5"></div>
<div class="pt-5"></div>
<div class="container pt-5">
  <div class="row">
    <!-- Sol Menü -->
    <div class="col-md-3">
      <div class="list-group menu" id="menu">
        <a href="#" class="list-group-item list-group-item-action active" aria-current="true" onclick="showHome()" id="homeLink">
          <i class="fas fa-home me-2"></i> Anasayfa
        </a>
        <a href="#" class="list-group-item list-group-item-action" onclick="showMessages()" id="messagesLink"> 
          <i class="far fa-envelope me-2"></i> Mesaj Kontrol
        </a>
        <a href="#" class="list-group-item list-group-item-action" onclick="showKayitKontrol()" id="kullanici_kayit_kontrol_Link">
          <i class="far fa-user me-2"></i> Kullanıcı Kayıt Kontrol
        </a>
        <a href="#" class="list-group-item list-group-item-action" onclick="showKullaniciGiris()" id="kullanici_giris_cikis_Link">
          <i class="far fa-user-circle me-2"></i> Kullanıcı Son Giriş Çıkış Kontrol
        </a>
        <a href="#" class="list-group-item list-group-item-action" onclick="showSepetGiris()" id="sepet_giris_Link">
          <i class="fas fa-shopping-cart me-2"></i> Sepet Girişi Kontrol
        </a>
      </div>
    </div>
    <!-- ANA SAYFA İÇERİK -->
    <div class="col-md-9" id="contentPanel">
      <div class="card">
        <div class="card-header">
          Hoş geldiniz Admin!
        </div>
        <div class="card-body">
          <h5 class="card-title">Admin Paneli</h5>
          <p class="card-text">Bu panelde yönetim işlemlerinizi gerçekleştirebilirsiniz. Sol taraftaki menüden istediğiniz işlemi seçebilirsiniz.</p>
        </div>
      </div>
      <div class="card">
        <div class="card-header">
          Hızlı Erişim
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="card mb-3">
                <div class="card-body">
                  <h6 class="card-title">Toplam Kullanıcı Sayısı</h6>
                  <p class="card-text">1456</p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card mb-3">
                <div class="card-body">
                  <h6 class="card-title">Toplam Mesaj Sayısı</h6>
                  <p class="card-text">328</p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card mb-3">
                <div class="card-body">
                  <h6 class="card-title">Yeni Kullanıcılar Bugün</h6>
                  <p class="card-text">22</p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card mb-3">
                <div class="card-body">
                  <h6 class="card-title">Aktif Kullanıcılar</h6>
                  <p class="card-text">120</p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card mb-3">
                <div class="card-body">
                  <h6 class="card-title">Yeni Mesajlar</h6>
                  <p class="card-text">8</p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card mb-3">
                <div class="card-body">
                  <h6 class="card-title">Sepet İçeriği</h6>
                  <p class="card-text">15</p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card mb-3">
                <div class="card-body">
                  <h6 class="card-title">Yorumlar</h6>
                  <p class="card-text">42</p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card mb-3">
                <div class="card-body">
                  <h6 class="card-title">Satış İstatistikleri</h6>
                  <p class="card-text">289</p>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
    <!-- ANA SAYFA İÇERİK BİTİŞ-->



    <!-- MESAJ KONTROL -->
    <div class="col-md-9" id="messagePanel" style="display: none;">
      <div class="card">
        <div class="card-header">
          Mesaj Kontrol
        </div>
        <div class="card-body">
          <div class="table-wrapper">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Adı</th>
                  <th scope="col">Soyadı</th>
                  <th scope="col">Eposta</th>
                  <th scope="col">Telefon</th>
                  <th scope="col">Adres</th>
                  <th scope="col">Konu</th>
                  <th scope="col">Mesaj</th>
                  <th scope="col">Atılma Zamanı</th>
                </tr>
              </thead>
              <tbody>
                <?php
                    if ( $query->rowCount() ){

                        foreach( $query as $row ){
                            $id=$row['id'];
                            $adi=$row['adi'];
                            $soyadi=$row['soyadi'];
                            $eposta=$row['eposta'];
                            $telefon=$row['telefon'];
                            $adres=$row['adres'];
                            $konu=$row['konu'];
                            $mesaj=$row['mesaj'];
                            $saat=$row['saat'];

                            
                    ?> 
                    
                    <tr>
                        <td><?=$adi?></td>
                        <td><?=$soyadi?></td>
                        <td><?=$eposta?></td>
                        <td><?=$telefon?></td>
                        <td><?=$adres?></td>
                        <td><?=$konu?></td>
                        <td class="message-content" data-message="<?=$mesaj?>">
                        Üzerime tıklayıp mesajı öğrenebilirsin.
                        </td>
                        <td><?=$saat?></td>
                    </tr>
                   
                    <?php 
                    }
                    } 
                    ?>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
<!-- MESAJ KONTROL BİTİŞ-->




<!-- KULLANICI KAYIT KONTROL -->
<div class="col-md-9" id="kullanici_kayit_Panel" style="display: none;">
      <div class="card">
        <div class="card-header">
          Kullanıcı Kayıt Kontrol
        </div>
        <div class="card-body">
          <div class="table-wrapper">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Kullanıcı Maili</th>
                  <th scope="col">Kullanıcı Şifresi</th>
                  <th scope="col">Kullanıcı Üyeliği</th>
                  <th scope="col">Kayıt Tarihi</th>
                  <th scope="col">Kayıt Adresi</th>
                </tr>
              </thead>
              <tbody>
              <?php
                    if ( $query1->rowCount() ){

                        foreach( $query1 as $row ){
                            $id1=$row['id'];
                            $eposta=$row['eposta'];
                            $sifre=$row['sifre'];
                            $uyelik=$row['uyelik'];
                            $kayit_tarihi=$row['kayit_tarihi'];
                            $kayit_adresi=$row['kayit_adresi'];

                            
                    ?> 
                    
                    <tr>
                        <td><?=$eposta?></td>
                        <td><?=$sifre?></td>
                        <td><?=$uyelik?></td>
                        <td><?=$kayit_tarihi?></td>
                        <td><?=$kayit_adresi?></td>
                    </tr>
                   
                    <?php 
                    }
                    } 
                    ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
<!-- KULLANICI KAYIT KONTROL BİTİŞ-->



<!-- KULLANICI GİRİŞ ÇIKIŞ KONTROL -->
<div class="col-md-9" id="kullanici_giris_cikis_Panel" style="display: none;">
      <div class="card">
        <div class="card-header">
          Kullanıcı Son Giriş Çıkış Kontrol
        </div>
        <div class="card-body">
          <div class="table-wrapper">
            <table class="table">
              <thead>
                <tr>
                 <th scope="col">Kullanıcı</th>
                  <th scope="col">Kullanıcı Giriş Saati</th>
                  <th scope="col">Kullanıcı Giriş Adresi</th>
                  <th scope="col">Kullanıcı Çıkış Saati</th>
                  <th scope="col">Kullanıcı Giriş Adresi</th>
                </tr>
              </thead>
              <tbody>
              <?php
                    if ( $stmt->rowCount() ){

                        foreach( $stmt as $row ){
                          $giris_saat = $row["giris_saat"];
                          $giris_adres = $row["giris_adres"];
                          $cikis_saat = $row["cikis_saat"];
                          $cikis_adres = $row["cikis_adres"];
                          $giris_mail = $row["giris_mail"];
                          $username = explode('@', $giris_mail)[0];

                            
                    ?> 
                    
                    <tr>
                        <td><?=$username?></td>
                        <td><?=$giris_saat?></td>
                        <td><?=$giris_adres?></td>
                        <td><?=$cikis_saat?></td>
                        <td><?=$cikis_adres?></td>
                    </tr>
                   
                    <?php 
                    }
                    } 
                    ?>
              
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
<!-- KULLANICI GİRİŞ ÇIKIŞ KONTROL BİTİŞ-->



<!-- SEPET GİRİŞ KONTROL -->
<div class="col-md-9" id="sepet_giris_Panel" style="display: none;">
      <div class="card">
        <div class="card-header">
          Sepet Giriş Kontrol
        </div>
        <div class="card-body">
          <div class="table-wrapper">
            <table class="table">
              <thead>
                <tr>
                 <th scope="col">Kullanıcı Adı</th>
                  <th scope="col">Sepetine Eklediği Ürün</th>
                  <th scope="col">Sepetine Eklediği Ürün Ücreti</th>
                  <th scope="col">Eklediği Zaman</th>
                  <th scope="col">Eklediği Adres</th>
                </tr>
              </thead>
              <tbody>
              <?php
                    if ( $query2->rowCount() ){

                        foreach( $query2 as $row ){
                            $sepet_mail=$row['sepet_mail'];
                            $sepet_urun=$row['sepet_urun'];
                            $sepet_tarih=$row['sepet_tarih'];
                            $sepet_adres=$row['sepet_adres'];
                            $sepet_ucret=$row['sepet_ucret'];
                            
                    ?> 
                    
                    <tr>
                        <td><?=$sepet_mail?></td>
                        <td><?=$sepet_urun?></td>
                        <td><?=$sepet_ucret?></td>
                        <td><?=$sepet_tarih?></td>
                        <td><?=$sepet_adres?></td>
                    </tr>
                   
                    <?php 
                    }
                    } 
                    ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
<!-- SEPET GİRİŞ KONTROL BİTİŞ-->

</div>
</div>
    


<!-- Modal -->
<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="messageModalLabel">Mesaj Detayı</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="messageModalBody">
        <!-- Mesaj içeriği buraya gelecek -->
      </div>
    </div>
  </div>
</div>




<!-- PANEL BİTİŞ -->

    <!-- KİŞİSEL JAVASCRIPT -->
    <script src="../js/script.js"></script>
    <script src="../js/script2.js"></script>
    <script src="../js/script3.js"></script>
    <script src="../js/script11.js"></script>
    <script src="../js/script12.js"></script>
</body>
</html>
