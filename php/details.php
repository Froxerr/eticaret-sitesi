<?php
  require_once 'baglan.php';
  try {
  $sql = 'SELECT genel_kategori, alt_kategori FROM urun_kategoriler';
    $stmt = $DBcon->prepare($sql);
    $stmt->execute();

    // Verileri çek
    $veriler = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Verileri gruplamak için diziyi oluştur
    $kategoriDizisi = array();

    foreach ($veriler as $veri) {
      $genelKategori = $veri['genel_kategori'];
      $altKategori = $veri['alt_kategori'];
      
      if (!isset($kategoriDizisi[$genelKategori])) {
          $kategoriDizisi[$genelKategori] = array();
      }
      
      $kategoriDizisi[$genelKategori][] = $altKategori;
  }


  if (isset($_POST['search'])) {
    $submitDegeri = $_POST['search'];

    $anaKategori = null;

    foreach ($kategoriDizisi as $genelKategori => $altKategoriler) {
        if (in_array($submitDegeri, $altKategoriler)) {
            $anaKategori = $genelKategori;
            break;
        }
    }

    if ($anaKategori) {
        echo "Alt kategori '$submitDegeri' şu ana kategoriye ait: '$anaKategori'";
    } else {
        echo "Alt kategori '$submitDegeri' herhangi bir ana kategoriye ait değil.";
    }
  } 


  $baseUrl_makyaj = "satis-Makyaj_kategori.php?kategori=";
  $baseUrl_ciltBakim = "satis-CiltBakim_kategori.php?kategori=";
  $baseUrl_sacBakim = "satis-SacBakim_kategori.php?kategori=";
  $baseUrl_kisiselBakim = "satis-KisiselBakim_kategori.php?kategori=";
  $baseUrl_parfumveDeodorant = "satis-ParfumveDeodorant_kategori.php?kategori=";

  if($anaKategori == "Makyaj")
  {
    $kategoriUrl = urlencode($submitDegeri);
    $dinamikUrl = $baseUrl_makyaj . $kategoriUrl;
    header("Location: $dinamikUrl");
    exit;
  }
  else if($anaKategori == "Cilt Bakımı")
  {
    $kategoriUrl = urlencode($submitDegeri);
    $dinamikUrl = $baseUrl_ciltBakim . $kategoriUrl;
    header("Location: $dinamikUrl");
    exit;
  }
  else if($anaKategori == "Saç Bakımı")
  {
    $kategoriUrl = urlencode($submitDegeri);
    $dinamikUrl = $baseUrl_sacBakim . $kategoriUrl;
    header("Location: $dinamikUrl");
    exit;
  }
  else if($anaKategori == "Kişisel Bakım")
  {
    $kategoriUrl = urlencode($submitDegeri);
    $dinamikUrl = $baseUrl_kisiselBakim . $kategoriUrl;
    header("Location: $dinamikUrl");
    exit;
  }
  else if($anaKategori == "Parfüm ve Deodorant")
  {
    $kategoriUrl = urlencode($submitDegeri);
    $dinamikUrl = $baseUrl_parfumveDeodorant . $kategoriUrl;
    header("Location: $dinamikUrl");
    exit;
  }
  else
  {
    echo "Bir sorun oluştu lütfen tekrar deneyiniz...";
    header("Location: index.php");
    exit;
  }
  

  } catch (PDOException $e) {
    echo "Bağlantı hatası: " . $e->getMessage();
}
?>