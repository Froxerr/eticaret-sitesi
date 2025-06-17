<?php
session_start();
include('baglan.php');

// Kullanıcı giriş yapmış mı kontrol et
if (!isset($_SESSION['username'])) {
    header("Location: giris.php");
    exit();
}

// Sepet boş mu kontrol et
if (!isset($_SESSION["cart"]) || empty($_SESSION["cart"])) {
    header("Location: index.php");
    exit();
}

// Form gönderilmiş mi kontrol et
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Gerekli alanların dolu olup olmadığını kontrol et
    $required_fields = [
        'name',
        'address',
        'phone',
        'email',
        'card_number',
        'expiry',
        'cvv'
    ];

    $errors = [];
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $errors[] = ucfirst(str_replace('_', ' ', $field)) . " alanı boş bırakılamaz.";
        }
    }

    // Kart numarası formatını kontrol et (sadece sayılar ve 16 haneli)
    if (!empty($_POST['card_number']) && !preg_match('/^[0-9]{16}$/', str_replace(' ', '', $_POST['card_number']))) {
        $errors[] = "Geçersiz kart numarası.";
    }

    // Son kullanma tarihi formatını kontrol et (MM/YY)
    if (!empty($_POST['expiry']) && !preg_match('/^(0[1-9]|1[0-2])\/([0-9]{2})$/', $_POST['expiry'])) {
        $errors[] = "Geçersiz son kullanma tarihi. Format: AA/YY";
    }

    // CVV formatını kontrol et (3 veya 4 haneli sayı)
    if (!empty($_POST['cvv']) && !preg_match('/^[0-9]{3,4}$/', $_POST['cvv'])) {
        $errors[] = "Geçersiz CVV.";
    }

    // E-posta formatını kontrol et
    if (!empty($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Geçersiz e-posta adresi.";
    }

    // Telefon numarası formatını kontrol et
    if (!empty($_POST['phone']) && !preg_match('/^[0-9]{10,11}$/', str_replace([' ', '(', ')', '-'], '', $_POST['phone']))) {
        $errors[] = "Geçersiz telefon numarası.";
    }

    // Hata yoksa siparişi kaydet ve sepeti temizle
    if (empty($errors)) {
        // Sipariş detaylarını veritabanına kaydet
        $currentDateTime = date("Y-m-d H:i:s");
        $username = $_SESSION['username'];
        $totalPrice = 0;

        // Toplam fiyatı hesapla
        foreach ($_SESSION["cart"] as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        try {
            // Sipariş kaydını oluştur
            $stmt = $DBcon->prepare("INSERT INTO siparisler (kullanici_adi, teslimat_adi, teslimat_adresi, teslimat_telefon, teslimat_email, siparis_tarihi, toplam_tutar) VALUES (:kullanici_adi, :teslimat_adi, :teslimat_adresi, :teslimat_telefon, :teslimat_email, :siparis_tarihi, :toplam_tutar)");
            
            $stmt->bindParam(':kullanici_adi', $username);
            $stmt->bindParam(':teslimat_adi', $_POST['name']);
            $stmt->bindParam(':teslimat_adresi', $_POST['address']);
            $stmt->bindParam(':teslimat_telefon', $_POST['phone']);
            $stmt->bindParam(':teslimat_email', $_POST['email']);
            $stmt->bindParam(':siparis_tarihi', $currentDateTime);
            $stmt->bindParam(':toplam_tutar', $totalPrice);
            
            $stmt->execute();
            
            // Sipariş detaylarını kaydet
            $siparis_id = $DBcon->lastInsertId();
            foreach ($_SESSION["cart"] as $item) {
                $stmt = $DBcon->prepare("INSERT INTO siparis_detaylari (siparis_id, urun_adi, urun_fiyati, urun_adedi) VALUES (:siparis_id, :urun_adi, :urun_fiyati, :urun_adedi)");
                $stmt->bindParam(':siparis_id', $siparis_id);
                $stmt->bindParam(':urun_adi', $item['name']);
                $stmt->bindParam(':urun_fiyati', $item['price']);
                $stmt->bindParam(':urun_adedi', $item['quantity']);
                $stmt->execute();
            }

            // Sepeti temizle
            unset($_SESSION["cart"]);

            // Başarılı mesajını göster
            $success = true;
        } catch(PDOException $e) {
            $errors[] = "Sipariş kaydedilirken bir hata oluştu: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ödeme Sonucu</title>
    <link rel="icon" href="../img/favicon.ico" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <?php if (isset($success)): ?>
                    <div class="card text-center">
                        <div class="card-body">
                            <h1 class="card-title text-success mb-4">✓</h1>
                            <h2 class="card-title">Ödeme Başarılı!</h2>
                            <p class="card-text">Siparişiniz için teşekkür ederiz. Siparişiniz başarıyla alınmıştır.</p>
                            <div class="mt-3">
                                <a href="siparislerim.php" class="btn btn-success mb-2">Siparişlerimi Görüntüle</a><br>
                                <a href="index.php" class="btn btn-primary">Ana Sayfaya Dön</a>
                            </div>
                        </div>
                    </div>
                    <script>
                    $(document).ready(function() {
                        // Sepet içeriğini güncelle
                        if (window.parent && window.parent.document) {
                            const cartContent = window.parent.document.getElementById('cartContent');
                            if (cartContent) {
                                cartContent.innerHTML = "<p class='container'>Sepet Boş</p>";
                            }
                        }

                        // LocalStorage'ı temizle
                        localStorage.removeItem("cartContent");
                        localStorage.removeItem("cartUpdateTime");

                        // Parent window'a mesaj gönder
                        window.parent.postMessage('paymentComplete', '*');

                        // Offcanvas'ı kapat (eğer açıksa)
                        const cartSidebar = window.parent.document.getElementById('cartSidebar');
                        if (cartSidebar) {
                            const bsOffcanvas = bootstrap.Offcanvas.getInstance(cartSidebar);
                            if (bsOffcanvas) {
                                bsOffcanvas.hide();
                            }
                        }
                    });
                    </script>
                <?php elseif (!empty($errors)): ?>
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title text-danger">Hata!</h2>
                            <ul class="list-unstyled">
                                <?php foreach ($errors as $error): ?>
                                    <li class="text-danger"><?php echo $error; ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <a href="odeme.php" class="btn btn-primary">Ödeme Sayfasına Geri Dön</a>
                        </div>
                    </div>
                <?php else: ?>
                    <?php header("Location: odeme.php"); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 