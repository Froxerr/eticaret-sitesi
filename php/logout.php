<?php
session_start();
include('baglan.php');
// Eğer session 'username' doluysa, sıfırla ve session'ı sonlandır
if (isset($_SESSION['username'])) {
        $email = $_SESSION['eposta'];
        $sifre = $_SESSION['sifre'];
        $anahtar = $_SESSION['anahtar'];
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
        $stmt = $DBcon->prepare("INSERT INTO login_cikis (cikis_saat,cikis_adres,cikis_mail,cikis_sifre,benzersiz_anahtar) VALUES(:cikis_saat, :cikis_adres, :cikis_mail, :cikis_sifre, :benzersiz_anahtar)");
        $stmt->bindparam(':cikis_saat',$currentDateTime);
        $stmt->bindparam(':cikis_adres',$ip);
        $stmt->bindparam(':cikis_mail',$email);
        $stmt->bindparam(':cikis_sifre',$sifre);
        $stmt->bindparam(':benzersiz_anahtar',$anahtar);
        $stmt->execute();

        $_SESSION['username'] = null; 
        unset($_SESSION['username']); 

        $_SESSION['eposta'] = null; 
        unset($_SESSION['eposta']); 

        $_SESSION['uyelik'] = null; 
        unset($_SESSION['uyelik']); 

        $_SESSION['sifre'] = null; 
        unset($_SESSION['sifre']); 

        $_SESSION['anahtar'] = null; 
        unset($_SESSION['anahtar']); 

        setcookie('remember_me_cookie', '', time() - 3600, '/');
   
        session_unset();
        session_destroy();

    // Çıkış işlemi başarılı olarak işaretlenir
    $result = ['success' => true];
} else {
    // Eğer 'username' session'ı zaten boşsa veya tanımsızsa
    $result = ['success' => false, 'message' => 'Zaten çıkış yapılmış'];
}

// JSON olarak sonucu döndür
header('Content-Type: application/json');
echo json_encode($result);
?>