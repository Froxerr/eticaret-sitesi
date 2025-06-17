<?php
session_start();
include('baglan.php');

// Toplam tutarı hesapla
$totalPrice = 0;
if (isset($_SESSION["cart"])) {
    foreach ($_SESSION["cart"] as $item) {
        $totalPrice += $item['price'] * $item['quantity'];
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sepetim - Kozmetik E-Ticaret</title>
    <link rel="icon" href="../img/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <h2 class="mb-4">Sepetim</h2>
                <?php if (!isset($_SESSION["cart"]) || empty($_SESSION["cart"])): ?>
                    <div class="alert alert-info">
                        Sepetiniz boş. Alışverişe devam etmek için <a href="index.php">tıklayın</a>.
                    </div>
                <?php else: ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Ürün</th>
                                            <th>Fiyat</th>
                                            <th>Adet</th>
                                            <th>Toplam</th>
                                            <th>İşlemler</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($_SESSION["cart"] as $item): ?>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="../img/<?php echo $item['img']; ?>" alt="<?php echo $item['name']; ?>" class="img-thumbnail me-3" style="width: 80px;">
                                                        <span><?php echo $item['name']; ?></span>
                                                    </div>
                                                </td>
                                                <td><?php echo $item['price']; ?>₺</td>
                                                <td>
                                                    <div class="input-group" style="width: 130px;">
                                                        <input type="number" class="form-control" id="quantity_<?php echo $item['id']; ?>" value="<?php echo $item['quantity']; ?>" min="1">
                                                        <button class="btn btn-outline-secondary update-cart-btn" type="button" data-id="<?php echo $item['id']; ?>">
                                                            <i class="fas fa-sync-alt"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td><strong><?php echo $item['price'] * $item['quantity']; ?>₺</strong></td>
                                                <td>
                                                    <button class="btn btn-danger btn-sm remove-cart-btn" type="button" data-id="<?php echo $item['id']; ?>">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="border-top pt-4 mt-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="index.php" class="btn btn-outline-primary">
                                            <i class="fas fa-arrow-left me-2"></i>Alışverişe Devam Et
                                        </a>
                                    </div>
                                    <div class="col-md-6 text-end">
                                        <h4 class="mb-3">Toplam: <strong><?php echo $totalPrice; ?>₺</strong></h4>
                                        <a href="odeme.php" class="btn btn-success btn-lg">
                                            Ödemeye Geç<i class="fas fa-arrow-right ms-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Ürün güncelleme
            $('.update-cart-btn').click(function() {
                var productId = $(this).data('id');
                var quantity = $('#quantity_' + productId).val();
                
                $.ajax({
                    url: 'update_adet.php',
                    method: 'POST',
                    data: {
                        product_id: productId,
                        quantity: quantity
                    },
                    success: function(response) {
                        location.reload();
                    }
                });
            });

            // Ürün silme
            $('.remove-cart-btn').click(function() {
                var productId = $(this).data('id');
                
                $.ajax({
                    url: 'remove_sepet.php',
                    method: 'POST',
                    data: {
                        product_id: productId
                    },
                    success: function(response) {
                        location.reload();
                    }
                });
            });
        });
    </script>
</body>
</html> 