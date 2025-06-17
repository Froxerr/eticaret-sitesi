<?php
session_start();
include("baglan.php");

// Kullanıcı girişi kontrolü
if (!isset($_SESSION['username'])) {
    header("Location: giris.php");
    exit();
}

// Sepet kontrolü
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("Location: index.php");
    exit();
}

// Toplam fiyat hesaplama
$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'] * $item['quantity'];
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ödeme - Kozmetik Mağazası</title>
    <link rel="icon" href="../img/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .payment-container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 30px;
        }
        .payment-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            padding: 30px;
            margin-bottom: 30px;
        }
        .card-header-custom {
            border-bottom: 2px solid #f0f0f0;
            margin-bottom: 20px;
            padding-bottom: 15px;
        }
        .form-control {
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 15px;
        }
        .btn-primary {
            background-color: #5c6bc0;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #3f51b5;
            transform: translateY(-2px);
        }
        .order-summary {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
        }
        .product-item {
            display: flex;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        .product-item img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 15px;
        }
        .product-details {
            flex-grow: 1;
        }
        .total-price {
            font-size: 1.25rem;
            font-weight: 600;
            color: #2196f3;
        }
        .card-icon {
            font-size: 24px;
            margin-right: 10px;
            color: #5c6bc0;
        }
        .secure-payment {
            display: flex;
            align-items: center;
            margin-top: 20px;
            color: #666;
        }
        .secure-payment i {
            margin-right: 10px;
            color: #4caf50;
        }
        @media (max-width: 768px) {
            .payment-container {
                padding: 15px;
            }
            .payment-card {
                padding: 20px;
            }
        }
    </style>
</head>
<body>

<div class="payment-container">
    <div class="row">
        <div class="col-md-8">
            <div class="payment-card">
                <div class="card-header-custom">
                    <h3><i class="fas fa-shipping-fast card-icon"></i>Teslimat Bilgileri</h3>
                </div>
                <form id="payment-form" action="odeme_tamamla.php" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Ad Soyad</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Telefon</label>
                                <input type="tel" class="form-control" name="phone" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">E-posta</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Adres</label>
                        <textarea class="form-control" name="address" rows="3" required></textarea>
                    </div>

                    <div class="card-header-custom mt-5">
                        <h3><i class="fas fa-credit-card card-icon"></i>Ödeme Bilgileri</h3>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kart Üzerindeki İsim</label>
                        <input type="text" class="form-control" name="card_name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kart Numarası</label>
                        <input type="text" class="form-control" name="card_number" id="card_number" maxlength="19" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Son Kullanma Tarihi</label>
                                <input type="text" class="form-control" name="expiry" id="expiry" placeholder="AA/YY" maxlength="5" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">CVV</label>
                                <input type="text" class="form-control" name="cvv" id="cvv" maxlength="3" required>
                            </div>
                        </div>
                    </div>
                    <div class="secure-payment">
                        <i class="fas fa-lock"></i>
                        <span>Ödemeniz 256-bit SSL ile güvenle şifrelenmektedir.</span>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-4">Ödemeyi Tamamla</button>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="payment-card">
                <div class="card-header-custom">
                    <h3><i class="fas fa-shopping-cart card-icon"></i>Sipariş Özeti</h3>
                </div>
                <div class="order-summary">
                    <?php foreach ($_SESSION['cart'] as $item): ?>
                    <div class="product-item">
                        <img src="../img/<?php echo $item['img']; ?>" alt="<?php echo $item['name']; ?>">
                        <div class="product-details">
                            <h6 class="mb-1"><?php echo $item['name']; ?></h6>
                            <p class="mb-0">Adet: <?php echo $item['quantity']; ?></p>
                            <p class="mb-0"><?php echo $item['price']; ?> ₺</p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <div class="mt-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5>Toplam</h5>
                            <span class="total-price"><?php echo number_format($total, 2); ?> ₺</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.getElementById('card_number').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    value = value.replace(/(.{4})/g, '$1 ').trim();
    e.target.value = value;
});

document.getElementById('expiry').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    if (value.length >= 2) {
        value = value.slice(0,2) + '/' + value.slice(2);
    }
    e.target.value = value;
});

document.getElementById('cvv').addEventListener('input', function(e) {
    e.target.value = e.target.value.replace(/\D/g, '');
});
</script>

</body>
</html> 