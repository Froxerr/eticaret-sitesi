<?php

session_start();
include('baglan.php');

require '../vendor/autoload.php'; // Composer autoload

use Ramsey\Uuid\Uuid;
$uuid = Uuid::uuid4()->toString();

header('Content-Type: application/json');

// Form verilerini al
$password = $_POST['password'] ?? '';
$email = $_POST['email'] ?? '';

// Basit bir kontrol
if (empty($password) || empty($email)) {
    echo json_encode(['success' => false, 'message' => 'Tüm yerlerin doldurulması lazım.']);
    exit;
}

// Kullanıcı sorgusu
$sorgu = $DBcon->prepare("SELECT * FROM login WHERE eposta = :email");
$sorgu->bindParam(':email', $email);
$sorgu->execute();
$cikti = $sorgu->fetch(PDO::FETCH_ASSOC);

if ($cikti) {
    // Şifre kontrolü
    if ($cikti["sifre"] === $password) 
    {
        $username = explode('@', $email)[0];
        $_SESSION['username'] = $username;
        $_SESSION['eposta'] = $cikti["eposta"];
        $_SESSION['sifre'] = $cikti["sifre"];
        $_SESSION['anahtar'] = $uuid;
        
        $currentDateTime = date("Y-m-d H:i:s");
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
        $stmt = $DBcon->prepare("INSERT INTO login_giris (giris_saat,giris_adres,giris_mail,giris_sifre,benzersiz_anahtar) VALUES(:giris_saat, :giris_adres, :giris_mail, :giris_sifre, :benzersiz_anahtar)");
        $stmt->bindparam(':giris_saat',$currentDateTime);
        $stmt->bindparam(':giris_adres',$ip);
        $stmt->bindparam(':giris_mail',$email);
        $stmt->bindparam(':giris_sifre',$password);
        $stmt->bindparam(':benzersiz_anahtar',$uuid);
        $stmt->execute();

        if (isset($_POST['rememberMe'])) {
            // 30 gün sürecek bir çerez oluştur
            $cookie_name = "remember_me_cookie";
            $cookie_value = $username; // Burada kullanıcı adını veya başka bir benzersiz bilgiyi kullanabilirsiniz
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 gün
        }

        echo json_encode(['success' => true, 'username' => $username]);
        exit;
    } else {
        echo json_encode(['success' => false, 'message' => 'Girdiğiniz şifre yanlış.']);
        exit;
    }
} 
else {
    echo json_encode(['success' => false, 'message' => 'Girdiğiniz email adresi ile eşleşen bir kayıt bulunamadı.']);
    exit;
}
?>
