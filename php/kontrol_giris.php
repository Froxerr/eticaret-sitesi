<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include('baglan.php');

header('Content-Type: application/json');

// Form verilerini al ve boş kontrolü yap
if (!isset($_POST['password']) || !isset($_POST['email'])) {
    echo json_encode(['success' => false, 'message' => 'Email veya şifre gönderilmedi.']);
    exit;
}

$password = $_POST['password'];
$email = $_POST['email'];

// Boş değer kontrolü
if (empty($password) || empty($email)) {
    echo json_encode(['success' => false, 'message' => 'Tüm yerlerin doldurulması lazım.']);
    exit;
}

try {
    // Kullanıcı sorgusu
    $sorgu = $DBcon->prepare("SELECT * FROM login WHERE eposta = :email");
    $sorgu->bindParam(':email', $email);
    $sorgu->execute();
    $cikti = $sorgu->fetch(PDO::FETCH_ASSOC);

    if ($cikti) {
        // Hash'lenmiş şifre kontrolü
        if (password_verify($password, $cikti["sifre"])) 
        {
            $username = explode('@', $email)[0];
            // Basit bir benzersiz ID oluştur
            $session_id = md5(uniqid($username, true));
            
            $_SESSION['username'] = $username;
            $_SESSION['eposta'] = $cikti["eposta"];
            $_SESSION['sifre'] = $cikti["sifre"];
            $_SESSION['anahtar'] = $session_id;
            
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
            
            try {
                $stmt = $DBcon->prepare("INSERT INTO login_giris (giris_saat,giris_adres,giris_mail,giris_sifre,benzersiz_anahtar) VALUES(:giris_saat, :giris_adres, :giris_mail, :giris_sifre, :benzersiz_anahtar)");
                $stmt->bindparam(':giris_saat',$currentDateTime);
                $stmt->bindparam(':giris_adres',$ip);
                $stmt->bindparam(':giris_mail',$email);
                $stmt->bindparam(':giris_sifre',$cikti["sifre"]); // Hash'lenmiş şifreyi kaydediyoruz
                $stmt->bindparam(':benzersiz_anahtar',$session_id);
                
                if (!$stmt->execute()) {
                    $error = $stmt->errorInfo();
                    error_log('Giriş log kaydı hatası: ' . $error[2]);
                }
            } catch(PDOException $e) {
                error_log('Giriş log kaydı hatası: ' . $e->getMessage());
            }

            if (isset($_POST['rememberMe'])) {
                $cookie_name = "remember_me_cookie";
                $cookie_value = $username;
                setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
            }

            echo json_encode(['success' => true, 'username' => $username]);
            exit;
        } else {
            echo json_encode(['success' => false, 'message' => 'Girdiğiniz şifre yanlış.']);
            exit;
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Girdiğiniz email adresi ile eşleşen bir kayıt bulunamadı.']);
        exit;
    }
} catch(PDOException $e) {
    error_log('Veritabanı hatası: ' . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Bir hata oluştu, lütfen daha sonra tekrar deneyin.']);
    exit;
}
?>
