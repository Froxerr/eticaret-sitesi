<?php
session_start();
include('baglan.php');

// Kullanıcı giriş yapmış mı kontrol et
if (!isset($_SESSION['username'])) {
    header("Location: giris.php");
    exit();
}

// Kullanıcının siparişlerini getir
$username = $_SESSION['username'];
$stmt = $DBcon->prepare("
    SELECT s.*, sd.urun_adi, sd.urun_fiyati, sd.urun_adedi, u.urun_resimi, u.id as urun_id 
    FROM siparisler s 
    LEFT JOIN siparis_detaylari sd ON s.id = sd.siparis_id 
    LEFT JOIN urunler u ON sd.urun_adi COLLATE utf8mb4_general_ci = u.urun_adi COLLATE utf8mb4_general_ci
    WHERE s.kullanici_adi = :username 
    ORDER BY s.siparis_tarihi DESC
");
$stmt->bindParam(':username', $username);
$stmt->execute();
$siparisler = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Siparişleri grupla
$grouped_siparisler = [];
foreach ($siparisler as $siparis) {
    if (!isset($grouped_siparisler[$siparis['id']])) {
        $grouped_siparisler[$siparis['id']] = [
            'id' => $siparis['id'],
            'teslimat_adi' => $siparis['teslimat_adi'],
            'teslimat_adresi' => $siparis['teslimat_adresi'],
            'teslimat_telefon' => $siparis['teslimat_telefon'],
            'teslimat_email' => $siparis['teslimat_email'],
            'siparis_tarihi' => $siparis['siparis_tarihi'],
            'toplam_tutar' => $siparis['toplam_tutar'],
            'urunler' => []
        ];
    }
    if ($siparis['urun_adi']) {
        $grouped_siparisler[$siparis['id']]['urunler'][] = [
            'urun_adi' => $siparis['urun_adi'],
            'urun_fiyati' => $siparis['urun_fiyati'],
            'urun_adedi' => $siparis['urun_adedi'],
            'resim_url' => $siparis['urun_resimi'],
            'urun_id' => $siparis['urun_id']
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siparişlerim - AAA</title>
    <title>ARAL - SSS</title>
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
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Junge&family=Crimson+Text:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Lora:ital,wght@0,400..700;1,400..700&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <style>
        .order-card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .order-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.08);
        }
        .order-header {
            background: linear-gradient(45deg, #f8f9fa, #ffffff);
            padding: 25px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }
        .order-body {
            padding: 25px;
        }
        .order-products {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 20px;
            margin-top: 20px;
        }
        .product-item {
            background: #fff;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 15px;
            transition: transform 0.2s ease;
        }
        .product-item:hover {
            transform: translateX(5px);
        }
        .product-item:last-child {
            margin-bottom: 0;
        }
        .status-badge {
            background: linear-gradient(45deg, #28a745, #20c997);
            color: white;
            padding: 8px 20px;
            border-radius: 25px;
            font-weight: 500;
            font-size: 0.9em;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .delivery-info {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 20px;
            margin-top: 20px;
        }
        .delivery-info-item {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
            padding: 10px;
            background: white;
            border-radius: 10px;
        }
        .delivery-info-item i {
            color: #6c757d;
            width: 20px;
            text-align: center;
        }
        .order-total {
            font-size: 1.4em;
            font-weight: 600;
            color: #2196f3;
            text-align: right;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 15px;
            margin-top: 20px;
        }
        .page-title {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: #333;
            margin-bottom: 40px;
            position: relative;
            display: inline-block;
        }
        .page-title:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 60px;
            height: 3px;
            background: linear-gradient(45deg, #2196f3, #20c997);
            border-radius: 3px;
        }
        .empty-orders {
            text-align: center;
            padding: 60px 20px;
            background: #f8f9fa;
            border-radius: 20px;
            margin-top: 30px;
        }
        .empty-orders i {
            font-size: 4em;
            color: #dee2e6;
            margin-bottom: 20px;
        }
        .empty-orders p {
            font-size: 1.2em;
            color: #6c757d;
            margin-bottom: 20px;
        }
        .shop-now-btn {
            background: linear-gradient(45deg, #2196f3, #20c997);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            font-weight: 500;
            text-decoration: none;
            transition: transform 0.2s ease;
        }
        .shop-now-btn:hover {
            transform: scale(1.05);
            color: white;
        }
        .filter-section {
            background: #fff;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }
        .filter-input {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 8px 15px;
            width: 100%;
            transition: all 0.3s ease;
        }
        .filter-input:focus {
            border-color: #2196f3;
            box-shadow: 0 0 0 2px rgba(33, 150, 243, 0.1);
            outline: none;
        }
        .date-filter {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
        }
        .date-filter input {
            flex: 1;
        }
        .product-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            transition: transform 0.2s ease;
            cursor: pointer;
        }
        .product-image:hover {
            transform: scale(1.05);
        }
        .page-title-section {
            margin-top: 120px;
            margin-bottom: 40px;
            text-align: center;
        }
        .page-title {
            font-size: 2.5em;
            margin-bottom: 20px;
        }
        .page-title:after {
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
        }
        .filter-button {
            background: linear-gradient(45deg, #2196f3, #20c997);
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .filter-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(33, 150, 243, 0.2);
        }
        .reset-button {
            background: #6c757d;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .reset-button:hover {
            background: #5a6268;
        }
    </style>
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
        <div class="offcanvas-body d-flex">
        <?php
            if (!function_exists('getCartContentHtml')) {
                require_once('cart_functions.php');
            }
            if (isset($_SESSION["cart"]) && !empty($_SESSION["cart"])) {
                echo "<div class='container' id='cartContent'>";
                echo getCartContentHtml($_SESSION["cart"]);
                echo "</div>";
            } else {
                echo "<p class='container' id='cartContent'>Sepet Boş</p>";
            }
        ?>
        </div>
    </div>
<!-- MENU BİTİŞ -->

<!-- SİPARİŞLER BAŞLANGIÇ -->
<div class="container">
    <div class="page-title-section">
        <h1 class="page-title">Siparişlerim</h1>
    </div>

    <div class="filter-section">
        <div class="row">
            <div class="col-md-4">
                <input type="text" id="orderSearch" class="filter-input" placeholder="Sipariş numarası veya ürün adı ile ara...">
            </div>
            <div class="col-md-6">
                <div class="date-filter">
                    <input type="date" id="startDate" class="filter-input" placeholder="Başlangıç tarihi">
                    <input type="date" id="endDate" class="filter-input" placeholder="Bitiş tarihi">
                </div>
            </div>
            <div class="col-md-2 text-end">
                <button class="filter-button" onclick="filterOrders()">
                    <i class="fas fa-filter me-2"></i>Filtrele
                </button>
                <button class="reset-button" onclick="resetFilters()">
                    <i class="fas fa-undo me-2"></i>
                </button>
            </div>
        </div>
    </div>

    <?php if (empty($grouped_siparisler)): ?>
        <div class="empty-orders">
            <i class="fas fa-shopping-bag"></i>
            <p>Henüz hiç siparişiniz bulunmamaktadır.</p>
            <a href="satis.php" class="shop-now-btn">
                <i class="fas fa-store me-2"></i>
                Alışverişe Başla
            </a>
        </div>
    <?php else: ?>
        <div id="ordersList">
        <?php foreach ($grouped_siparisler as $siparis): ?>
            <div class="order-card" data-order-id="<?php echo $siparis['id']; ?>" data-order-date="<?php echo $siparis['siparis_tarihi']; ?>">
                <div class="order-header">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <h5 class="mb-0">
                                <i class="fas fa-hashtag me-2"></i>
                                Sipariş #<?php echo $siparis['id']; ?>
                            </h5>
                        </div>
                        <div class="col-md-4 text-md-center">
                            <i class="far fa-calendar-alt me-2"></i>
                            <?php 
                                $tarih = new DateTime($siparis['siparis_tarihi']);
                                echo $tarih->format('d.m.Y H:i');
                            ?>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <span class="status-badge">
                                <i class="fas fa-check"></i>
                                Tamamlandı
                            </span>
                        </div>
                    </div>
                </div>
                <div class="order-body">
                    <div class="order-products">
                        <h5 class="mb-4">
                            <i class="fas fa-box-open me-2"></i>
                            Sipariş Detayları
                        </h5>
                        <?php foreach ($siparis['urunler'] as $urun): ?>
                            <div class="product-item">
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        <a href="satis_hakkinda.php?urun_id=<?php echo $urun['urun_id']; ?>">
                                            <img src="../img/<?php echo htmlspecialchars($urun['resim_url']); ?>" alt="<?php echo htmlspecialchars($urun['urun_adi']); ?>" class="product-image">
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <h6 class="mb-2"><?php echo htmlspecialchars($urun['urun_adi']); ?></h6>
                                        <small class="text-muted">Birim Fiyat: <?php echo number_format($urun['urun_fiyati'], 2); ?>₺</small>
                                    </div>
                                    <div class="col-md-3 text-md-center">
                                        <span class="badge bg-light text-dark">
                                            <i class="fas fa-times me-1"></i>
                                            <?php echo $urun['urun_adedi']; ?> Adet
                                        </span>
                                    </div>
                                    <div class="col-md-3 text-md-end">
                                        <strong><?php echo number_format($urun['urun_fiyati'] * $urun['urun_adedi'], 2); ?>₺</strong>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="delivery-info">
                        <h5 class="mb-4">
                            <i class="fas fa-truck me-2"></i>
                            Teslimat Bilgileri
                        </h5>
                        <div class="delivery-info-item">
                            <i class="fas fa-user"></i>
                            <span><?php echo htmlspecialchars($siparis['teslimat_adi']); ?></span>
                        </div>
                        <div class="delivery-info-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span><?php echo htmlspecialchars($siparis['teslimat_adresi']); ?></span>
                        </div>
                        <div class="delivery-info-item">
                            <i class="fas fa-phone"></i>
                            <span><?php echo htmlspecialchars($siparis['teslimat_telefon']); ?></span>
                        </div>
                        <div class="delivery-info-item">
                            <i class="fas fa-envelope"></i>
                            <span><?php echo htmlspecialchars($siparis['teslimat_email']); ?></span>
                        </div>
                    </div>

                    <div class="order-total">
                        <i class="fas fa-receipt me-2"></i>
                        Toplam: <?php echo number_format($siparis['toplam_tutar'], 2); ?>₺
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
<!-- SİPARİŞLER BİTİŞ -->

<!-- KULLANICI MODALI -->
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

<!-- KİŞİSEL JAVASCRIPT -->
<script src="../js/script.js"></script>
<script src="../js/script2.js"></script>
<script src="../js/script3.js"></script>
<script src="../js/script5.js"></script>
<script src="../js/script8.js"></script>
<script src="../js/script11.js"></script>
<script>
function filterOrders() {
    const searchText = document.getElementById('orderSearch').value.toLowerCase();
    const startDate = document.getElementById('startDate').value;
    const endDate = document.getElementById('endDate').value;
    
    const orders = document.querySelectorAll('.order-card');
    
    orders.forEach(order => {
        let showOrder = true;
        const orderDate = order.getAttribute('data-order-date');
        const orderContent = order.textContent.toLowerCase();
        
        // Metin araması
        if (searchText && !orderContent.includes(searchText)) {
            showOrder = false;
        }
        
        // Tarih filtresi
        if (startDate && orderDate < startDate) {
            showOrder = false;
        }
        if (endDate && orderDate > endDate) {
            showOrder = false;
        }
        
        order.style.display = showOrder ? 'block' : 'none';
    });
}

function resetFilters() {
    document.getElementById('orderSearch').value = '';
    document.getElementById('startDate').value = '';
    document.getElementById('endDate').value = '';
    
    const orders = document.querySelectorAll('.order-card');
    orders.forEach(order => {
        order.style.display = 'block';
    });
}

// Arama inputu için anlık filtreleme
document.getElementById('orderSearch').addEventListener('input', filterOrders);
document.getElementById('startDate').addEventListener('change', filterOrders);
document.getElementById('endDate').addEventListener('change', filterOrders);
</script>
</body>
</html> 