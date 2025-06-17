<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include('baglan.php');

header('Content-Type: application/json');

// Form verilerini al
$password = $_POST['password'];
$email = $_POST['email'];
$password_tekrar = $_POST['password_tekrar'];
$currentDateTime = date("Y-m-d H:i:s");

try {
    $sorgu=$DBcon->prepare("SELECT eposta FROM login");
    $sorgu->execute();

    while($cikti=$sorgu->fetch(PDO::FETCH_ASSOC)){
        if($cikti["eposta"]=="$email"){
            echo json_encode(['success' => false, 'message' => 'Yazdığınız mail mevcut. Başka bir mail girmeyi deneyiniz.']);
            exit();     
        }
    }

    // Basit bir kontrol
    if($password != $password_tekrar)
    {
        echo json_encode(['success' => false, 'message' => 'Şifre ile Şifre Doğrulaması Aynı Olmalı.']);
        exit;
    }
    if (empty($password) ||empty($password_tekrar) || empty($email)) {
        echo json_encode(['success' => false, 'message' => 'Tüm alanlar doldurulmalı.']);
        exit;
    }

    // Şifreyi güvenli bir şekilde hash'le
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    function getIPAddress() {  
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
         return $ip;  
    }  
    $ip = getIPAddress();  

    $stmt = $DBcon->prepare("INSERT INTO login(eposta,sifre,kayit_tarihi,kayit_adresi) VALUES(:eposta, :sifre, :kayit_tarihi, :kayit_adresi)");
    $stmt->bindparam(':eposta',$email);
    $stmt->bindparam(':sifre',$hashed_password);
    $stmt->bindparam(':kayit_tarihi',$currentDateTime);
    $stmt->bindparam(':kayit_adresi',$ip);

    if($stmt->execute())
    {
        echo json_encode(['success' => true]);
    }
    else {
        $error = $stmt->errorInfo();
        echo json_encode(['success' => false, 'message' => 'Veritabanı hatası: ' . $error[2]]);
        exit;
    }       
} catch(PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Hata: ' . $e->getMessage()]);
    exit;
}
exit;
?>
