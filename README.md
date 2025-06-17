<h1 align="center">
  <br>
  ARAL E-Ticaret Sitesi
  <br>
</h1>

<h4 align="center">Modern ve Kullanıcı Dostu Kozmetik E-Ticaret Platformu</h4>

<div align="center">
  <span style="display: inline-block; margin-right: 10px;">
    <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  </span>
  <span style="display: inline-block; margin-right: 10px;">
    <img src="https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black" alt="JavaScript">
  </span>
  <span style="display: inline-block; margin-right: 10px;">
    <img src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
  </span>
  <span style="display: inline-block; margin-right: 10px;">
    <img src="https://img.shields.io/badge/Bootstrap-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap">
  </span>
  <span style="display: inline-block;">
    <img src="https://img.shields.io/badge/jQuery-0769AD?style=for-the-badge&logo=jquery&logoColor=white" alt="jQuery">
  </span>
</div>

<p align="center">
  <a href="#özellikler">Özellikler</a> •
  <a href="#kullanıcı-özellikleri">Kullanıcı Özellikleri</a> •
  <a href="#kurulum">Kurulum</a> •
  <a href="#teknolojiler">Teknolojiler</a>
</p>

<h2 id="özellikler">Temel Özellikler</h2>

- **Modern Arayüz**: Bootstrap 5 ile tasarlanmış, kullanıcı dostu ve responsive tasarım
- **Gelişmiş Sepet Sistemi**: Real-time güncellenen, localStorage destekli alışveriş sepeti
- **Kategori Bazlı Ürün Yönetimi**: Kozmetik ürünleri için özelleştirilmiş kategori sistemi
- **Güvenli Ödeme Sistemi**: Form validasyonlu, güvenli ödeme işlemi
- **Sipariş Takibi**: Kullanıcılar için detaylı sipariş geçmişi ve takip sistemi
- **Oturum Yönetimi**: Güvenli kullanıcı girişi ve kayıt sistemi

<h2 id="kullanıcı-özellikleri">Kullanıcı Özellikleri</h2>

- **Ziyaretçiler İçin**:
  - Ürünleri görüntüleme ve filtreleme
  - Ürün detaylarını inceleme
  - Kullanıcı hesabı oluşturma

- **Kayıtlı Kullanıcılar İçin**:
  - Sepete ürün ekleme ve yönetme
  - Sipariş oluşturma ve ödeme yapma
  - Sipariş geçmişini görüntüleme
  - Profil bilgilerini güncelleme

<h2 id="kurulum">Kurulum</h2>

Projeyi yerel ortamınızda çalıştırmak için aşağıdaki adımları izleyin:

```bash
# Projeyi klonlayın
$ git clone https://github.com/kullaniciadi/eticaret-sitesi.git

# Proje dizinine gidin
$ cd eticaret-sitesi

# Veritabanını oluşturun
# MySQL veritabanınızda yeni bir veritabanı oluşturun ve .sql dosyasını import edin

# PHP sunucusunu başlatın
# Örneğin XAMPP, WAMP veya Laragon kullanabilirsiniz

# Tarayıcıda açın
http://localhost/eticaret-sitesi
```

<h2 id="teknolojiler">Kullanılan Teknolojiler</h2>

- **Frontend**:
  - HTML5, CSS3
  - JavaScript (ES6+)
  - Bootstrap 5
  - jQuery
  - Font Awesome

- **Backend**:
  - PHP 7+
  - MySQL
  - PDO Database Connection

- **Depolama**:
  - Session Management
  - LocalStorage
  - MySQL Database

- **Güvenlik**:
  - SQL Injection Prevention
  - XSS Protection
  - Form Validation
  - Secure Password Hashing

<h2 id="gereksinimler">Sistem Gereksinimleri</h2>

- PHP 7.0 veya üzeri
- MySQL 5.7 veya üzeri
- Web Sunucusu (Apache/Nginx)
- Modern bir web tarayıcısı

> **Not**
> Projeyi çalıştırmadan önce PHP ve MySQL ayarlarınızın doğru yapılandırıldığından emin olun.

---

<h2 id="gelistirici-notu">🎯 Geliştirici Notu</h2>

Bu proje, yazılım geliştirme yolculuğumdaki ilk kapsamlı çalışmam olup, birçok değerli deneyim ve öğrenme fırsatı sundu. Projeyi geliştirirken karşılaştığım zorluklar ve bunlardan çıkardığım dersler:

### 📚 Öğrenme Süreci

- **Kod Organizasyonu**: Başlangıçta tüm PHP kodlarını tek dosyada tutma eğilimindeydim, ancak bu yaklaşımın sürdürülebilir olmadığını öğrendim. Zamanla kodları modüler hale getirerek `cart_functions.php` gibi özelleşmiş dosyalara ayırdım.

- **JavaScript ve DOM Manipülasyonu**: Sepet işlemlerinde başlangıçta sayfayı sürekli yenileme yaklaşımını kullanıyordum. AJAX ve localStorage kullanımını öğrenerek daha iyi bir kullanıcı deneyimi sağlamayı başardım.

- **Veritabanı İlişkileri**: İlk başta tekrarlayan veriler ve normalize edilmemiş tablolar kullanıyordum. Süreç içinde veritabanı normalizasyonunun önemini kavrayarak tabloları daha verimli hale getirdim.

### 🔍 Önemli Öğrenimler

1. **Güvenlik Önlemleri**: SQL injection ve XSS saldırılarına karşı korumanın önemini öğrendim. PDO prepared statements ve input validasyonu gibi güvenlik pratiklerini uyguladım.

2. **Session Yönetimi**: Oturum yönetiminin sadece giriş/çıkış işlemi olmadığını, güvenlik ve kullanıcı deneyimi açısından kritik olduğunu deneyimledim.

3. **Responsive Tasarım**: Mobile-first yaklaşımının önemini kavradım ve Bootstrap framework'ünü daha etkin kullanmayı öğrendim.

### 🚀 Gelecek Geliştirmeler

Bu projede öğrendiklerim ışığında gelecekte yapmayı planladığım iyileştirmeler:

- MVC mimarisi kullanarak kod organizasyonunu iyileştirme
- Unit testler ekleyerek kod güvenilirliğini artırma
- API endpoint'leri oluşturarak daha modüler bir yapıya geçiş
- Daha güvenli ve kapsamlı bir ödeme sistemi entegrasyonu

### 💡 Tavsiyeler

Benzer bir projeye başlayacak geliştiriciler için önerilerim:
- Başlamadan önce proje yapısını ve veritabanı şemasını iyi planlayın
- Git versiyon kontrolünü projenin en başından kullanın
- Güvenlik önlemlerini geliştirme sürecinin başından itibaren uygulayın
- Kod tekrarından kaçının ve fonksiyonları modüler tutun

> **Önemli Not**: Bu proje, bir öğrenme sürecinin ürünüdür ve sürekli geliştirilmeye açıktır. Geri bildirimleriniz ve katkılarınız her zaman değerlidir.

---

> Bu proje eğitim amaçlı geliştirilmiş olup, gerçek bir e-ticaret sitesinin temel özelliklerini içermektedir.
