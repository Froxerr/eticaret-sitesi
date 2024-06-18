<?php
require_once 'baglan.php';

if (isset($_POST['query'])) {
  $inpText = $_POST['query'];
  $sql = 'SELECT DISTINCT alt_kategori FROM urun_kategoriler WHERE alt_kategori LIKE :urun';
  $stmt = $DBcon->prepare($sql);
  $stmt->execute(['urun' => '%' . $inpText . '%']);
  $result = $stmt->fetchAll();

  if ($result) {
    foreach ($result as $row) {
      echo '<a href="#" class="list-group-item">' . htmlspecialchars($row['alt_kategori']) . '</a>';
    }
  } else {
    echo '<a class="list-group-item list-group-item-empty">Kayıt Bulunamadı </a>';
  }
}
?>
