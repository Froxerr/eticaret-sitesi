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

// Yönetici kontrolü
if (!isset($_SESSION['eposta'])) {
    header("Location: index.php");
    exit();
}

include('baglan.php');

// Kullanıcı yetkisini kontrol et
$email = $_SESSION['eposta'];
$sorgu = $DBcon->prepare("SELECT uyelik FROM login WHERE eposta = :email");
$sorgu->bindParam(':email', $email);
$sorgu->execute();
$kullanici = $sorgu->fetch(PDO::FETCH_ASSOC);

if (!$kullanici || ($kullanici['uyelik'] !== 'Yönetici' && $kullanici['uyelik'] !== 'Admin')) {
    header("Location: index.php");
    exit();
}

$query = $DBcon->query("SELECT * FROM iletisim", PDO::FETCH_ASSOC);
$rowCount = $query->rowCount();

$query1 = $DBcon->query("SELECT * FROM login", PDO::FETCH_ASSOC);
$query2 = $DBcon->query("SELECT * FROM sepet_kontrol", PDO::FETCH_ASSOC);

// Aktif siparişleri çek
$aktif_siparis_query = $DBcon->query("SELECT COUNT(*) as aktif_siparis FROM sepet_kontrol");
$aktif_siparis = $aktif_siparis_query->fetch(PDO::FETCH_ASSOC);
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
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARAL Admin Panel</title>
    <link rel="icon" href="../img/favicon.ico" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Junge&family=Crimson+Text:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Lora:ital,wght@0,400..700;1,400..700&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #34495e;
            --accent-color: #3498db;
            --success-color: #2ecc71;
            --warning-color: #f1c40f;
            --danger-color: #e74c3c;
            --light-color: #ecf0f1;
            --dark-color: #2c3e50;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f8f9fa;
        }

        .admin-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 1rem 0;
            margin-bottom: 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .admin-title {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
        }

        .admin-subtitle {
            font-family: 'Lora', serif;
            opacity: 0.9;
        }

        .sidebar {
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
            padding: 1.5rem;
        }

        .list-group-item {
            border: none;
            border-radius: 7px !important;
            margin-bottom: 0.5rem;
            transition: all 0.3s ease;
        }

        .list-group-item:hover {
            background-color: var(--light-color);
            transform: translateX(5px);
        }

        .list-group-item.active {
            background: linear-gradient(135deg, var(--accent-color), var(--primary-color));
            border: none;
        }

        .content-area {
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
            padding: 2rem;
            height: auto;
        }

        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: var(--accent-color);
        }

        .stat-number {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary-color);
        }

        .stat-label {
            color: var(--secondary-color);
            font-size: 0.9rem;
        }

        .table {
            border-radius: 10px;
            overflow: hidden;
        }

        .table thead th {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 1rem;
            font-weight: 600;
        }

        .table td {
            padding: 1rem;
            vertical-align: middle;
        }

        .btn-custom {
            padding: 0.5rem 1.5rem;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .admin-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: rgba(255,255,255,0.1);
            border-radius: 10px;
            margin-bottom: 1rem;
        }

        .admin-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--light-color);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .admin-name {
            font-weight: 600;
            margin: 0;
        }

        .admin-role {
            font-size: 0.8rem;
            opacity: 0.8;
            margin: 0;
        }

        .avatar-sm {
            width: 32px;
            height: 32px;
            font-size: 0.875rem;
        }

        .badge {
            padding: 0.5rem 0.75rem;
            font-weight: 500;
        }

        .text-truncate {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
</head>
<body>
    <!-- Admin Header -->
    <div class="admin-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="admin-title mb-0">ARAL Yönetim Paneli</h1>
                    <p class="admin-subtitle mb-0">Sistem Yönetimi ve İstatistikler</p>
                </div>
                <div class="col-md-6">
                    <div class="admin-info">
                        <div class="admin-avatar">
                            <img src="https://api.dicebear.com/7.x/initials/svg?seed=<?php echo $_SESSION['username']; ?>" alt="Admin" class="img-fluid">
                        </div>
                        <div>
                            <p class="admin-name"><?php echo $_SESSION['username']; ?></p>
                            <p class="admin-role"><?php echo $_SESSION['uyelik']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <!-- Sol Menü -->
            <div class="col-md-3">
                <div class="sidebar">
                    <div class="list-group menu" id="menu">
                        <a href="#" class="list-group-item list-group-item-action active" onclick="showHome()" id="homeLink">
                            <i class="fas fa-home me-2"></i> Anasayfa
                        </a>
                        <a href="#" class="list-group-item list-group-item-action" onclick="showMessages()" id="messagesLink">
                            <i class="fas fa-envelope me-2"></i> Mesaj Kontrol
                        </a>
                        <a href="#" class="list-group-item list-group-item-action" onclick="showKayitKontrol()" id="kullanici_kayit_kontrol_Link">
                            <i class="fas fa-user-plus me-2"></i> Kullanıcı Kayıt Kontrol
                        </a>
                        <a href="#" class="list-group-item list-group-item-action" onclick="showKullaniciGiris()" id="kullanici_giris_cikis_Link">
                            <i class="fas fa-sign-in-alt me-2"></i> Kullanıcı Giriş/Çıkış
                        </a>
                        <a href="#" class="list-group-item list-group-item-action" onclick="showSepetGiris()" id="sepet_giris_Link">
                            <i class="fas fa-shopping-cart me-2"></i> Sepet Kontrol
                        </a>
                        <a href="index.php" class="list-group-item list-group-item-action text-danger">
                            <i class="fas fa-sign-out-alt me-2"></i> Panelden Çık
                        </a>
                    </div>
                </div>
            </div>

            <!-- Sağ İçerik Alanı -->
            <div class="col-md-9">
                <div class="content-area">
                    <!-- Ana Sayfa Paneli -->
                    <div id="contentPanel">
                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                <div class="stat-card">
                                    <div class="stat-icon">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div class="stat-number"><?php echo $query1->rowCount(); ?></div>
                                    <div class="stat-label">Toplam Kullanıcı</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="stat-card">
                                    <div class="stat-icon">
                                        <i class="fas fa-shopping-cart"></i>
                                    </div>
                                    <div class="stat-number"><?php echo $query2->rowCount(); ?></div>
                                    <div class="stat-label">Toplam Sipariş</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="stat-card">
                                    <div class="stat-icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="stat-number"><?php echo $rowCount; ?></div>
                                    <div class="stat-label">Toplam Mesaj</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Mesaj Kontrol Paneli -->
                    <div id="messagePanel" style="display: none;">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="mb-0">Mesaj Kontrol Paneli</h5>
                            <button class="btn btn-custom btn-sm" style="background: var(--accent-color); color: white;">
                                <i class="fas fa-sync-alt me-1"></i> Yenile
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th class="text-nowrap">Adı Soyadı</th>
                                        <th>İletişim</th>
                                        <th>Konu</th>
                                        <th>Mesaj</th>
                                        <th>Tarih</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($query->rowCount()) {
                                        foreach ($query as $row) {
                                            echo '<tr>';
                                            echo '<td class="text-nowrap">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm me-2 bg-light rounded-circle d-flex align-items-center justify-content-center">
                                                            <i class="fas fa-user text-muted"></i>
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-0">' . htmlspecialchars($row['adi']) . ' ' . htmlspecialchars($row['soyadi']) . '</h6>
                                                        </div>
                                                    </div>
                                                  </td>';
                                            echo '<td>
                                                    <div>
                                                        <div class="small text-muted"><i class="fas fa-envelope me-1"></i>' . htmlspecialchars($row['eposta']) . '</div>
                                                        <div class="small text-muted"><i class="fas fa-phone me-1"></i>' . htmlspecialchars($row['telefon']) . '</div>
                                                    </div>
                                                  </td>';
                                            echo '<td><span class="badge" style="background: var(--accent-color);">' . htmlspecialchars($row['konu']) . '</span></td>';
                                            echo '<td><p class="mb-0 text-truncate" style="max-width: 200px;">' . htmlspecialchars($row['mesaj']) . '</p></td>';
                                            echo '<td class="text-nowrap"><div class="small text-muted"><i class="fas fa-clock me-1"></i>' . htmlspecialchars($row['saat']) . '</div></td>';
                                            echo '</tr>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="5" class="text-center">Henüz mesaj bulunmuyor.</td></tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Kullanıcı Kayıt Kontrol Paneli -->
                    <div id="kullanici_kayit_Panel" style="display: none;">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="mb-0">Kullanıcı Kayıt Kontrol</h5>
                            <button class="btn btn-custom btn-sm" style="background: var(--accent-color); color: white;">
                                <i class="fas fa-sync-alt me-1"></i> Yenile
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th>Kullanıcı</th>
                                        <th>E-posta</th>
                                        <th>Üyelik</th>
                                        <th>Kayıt Tarihi</th>
                                        <th>Kayıt Adresi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($query1->rowCount()) {
                                        foreach ($query1 as $row) {
                                            $username = explode('@', $row['eposta'])[0];
                                            echo '<tr>';
                                            echo '<td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm me-2 bg-light rounded-circle d-flex align-items-center justify-content-center">
                                                            <i class="fas fa-user text-muted"></i>
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-0">' . htmlspecialchars($username) . '</h6>
                                                        </div>
                                                    </div>
                                                  </td>';
                                            echo '<td><div class="small text-muted"><i class="fas fa-envelope me-1"></i>' . htmlspecialchars($row['eposta']) . '</div></td>';
                                            echo '<td><span class="badge" style="background: var(--accent-color);">' . htmlspecialchars($row['uyelik']) . '</span></td>';
                                            echo '<td class="text-nowrap"><div class="small text-muted"><i class="fas fa-calendar me-1"></i>' . htmlspecialchars($row['kayit_tarihi']) . '</div></td>';
                                            echo '<td class="text-nowrap"><div class="small text-muted"><i class="fas fa-map-marker-alt me-1"></i>' . htmlspecialchars($row['kayit_adresi']) . '</div></td>';
                                            echo '</tr>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="5" class="text-center">Henüz kullanıcı bulunmuyor.</td></tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Kullanıcı Giriş/Çıkış Kontrol Paneli -->
                    <div id="kullanici_giris_cikis_Panel" style="display: none;">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="mb-0">Kullanıcı Giriş/Çıkış Kontrol</h5>
                            <button class="btn btn-custom btn-sm" style="background: var(--accent-color); color: white;">
                                <i class="fas fa-sync-alt me-1"></i> Yenile
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th>Kullanıcı</th>
                                        <th>Giriş Bilgileri</th>
                                        <th>Çıkış Bilgileri</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($stmt->rowCount()) {
                                        foreach ($stmt as $row) {
                                            $username = explode('@', $row['giris_mail'])[0];
                                            echo '<tr>';
                                            echo '<td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm me-2 bg-light rounded-circle d-flex align-items-center justify-content-center">
                                                            <i class="fas fa-user text-muted"></i>
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-0">' . htmlspecialchars($username) . '</h6>
                                                            <small class="text-muted">' . htmlspecialchars($row['giris_mail']) . '</small>
                                                        </div>
                                                    </div>
                                                  </td>';
                                            echo '<td>
                                                    <div class="small text-muted">
                                                        <div><i class="fas fa-clock me-1"></i>' . htmlspecialchars($row['giris_saat']) . '</div>
                                                        <div><i class="fas fa-map-marker-alt me-1"></i>' . htmlspecialchars($row['giris_adres']) . '</div>
                                                    </div>
                                                  </td>';
                                            echo '<td>
                                                    <div class="small text-muted">
                                                        <div><i class="fas fa-clock me-1"></i>' . htmlspecialchars($row['cikis_saat']) . '</div>
                                                        <div><i class="fas fa-map-marker-alt me-1"></i>' . htmlspecialchars($row['cikis_adres']) . '</div>
                                                    </div>
                                                  </td>';
                                            echo '</tr>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="3" class="text-center">Henüz giriş/çıkış kaydı bulunmuyor.</td></tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Sepet Kontrol Paneli -->
                    <div id="sepet_giris_Panel" style="display: none;">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="mb-0">Sepet Kontrol</h5>
                            <button class="btn btn-custom btn-sm" style="background: var(--accent-color); color: white;">
                                <i class="fas fa-sync-alt me-1"></i> Yenile
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th>Kullanıcı</th>
                                        <th>Ürün</th>
                                        <th>Ücret</th>
                                        <th>Tarih</th>
                                        <th>Adres</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($query2->rowCount()) {
                                        foreach ($query2 as $row) {
                                            $username = explode('@', $row['sepet_mail'])[0];
                                            echo '<tr>';
                                            echo '<td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm me-2 bg-light rounded-circle d-flex align-items-center justify-content-center">
                                                            <i class="fas fa-user text-muted"></i>
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-0">' . htmlspecialchars($username) . '</h6>
                                                            <small class="text-muted">' . htmlspecialchars($row['sepet_mail']) . '</small>
                                                        </div>
                                                    </div>
                                                  </td>';
                                            echo '<td><span class="badge" style="background: var(--accent-color);">' . htmlspecialchars($row['sepet_urun']) . '</span></td>';
                                            echo '<td><div class="small text-muted"><i class="fas fa-turkish-lira-sign me-1"></i>' . htmlspecialchars($row['sepet_ucret']) . ' TL</div></td>';
                                            echo '<td class="text-nowrap"><div class="small text-muted"><i class="fas fa-clock me-1"></i>' . htmlspecialchars($row['sepet_tarih']) . '</div></td>';
                                            echo '<td class="text-nowrap"><div class="small text-muted"><i class="fas fa-map-marker-alt me-1"></i>' . htmlspecialchars($row['sepet_adres']) . '</div></td>';
                                            echo '</tr>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="5" class="text-center">Henüz sepet kaydı bulunmuyor.</td></tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/script12.js"></script>
</body>
</html>
