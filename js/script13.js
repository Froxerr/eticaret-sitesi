document.addEventListener("DOMContentLoaded", function() {
    // Tüm kategori linklerini seçin
    const categoryLinks = document.querySelectorAll('#categoryList li a');

    // Her bir kategori linkine tıklama olayını ekleyin
    categoryLinks.forEach(link => {
        link.addEventListener('click', function(event) {
            // Tüm kategori linklerinden 'aktif' sınıfını kaldır
            categoryLinks.forEach(link => {
                link.classList.remove('aktif');
            });

            // Tıklanan linkin 'aktif' sınıfını ekle
            this.classList.add('aktif');

            // veya isteğe bağlı olarak localStorage'da saklayabilirsiniz
            localStorage.setItem('activeLink', this.href);
        });
    });

    // Sayfa yenilendiğinde localStorage'dan aktif linki alıp 'aktif' sınıfını ekle
    const activeLink = localStorage.getItem('activeLink');
    if (activeLink) {
        categoryLinks.forEach(link => {
            if (link.href === activeLink) {
                link.classList.add('aktif');
            }
        });
    } else {
        // Eğer localStorage'da aktif link yoksa, ilk kategori linkini aktif yap
        if (categoryLinks.length > 0) {
            categoryLinks[0].classList.add('aktif');
            localStorage.setItem('activeLink', categoryLinks[0].href);
        }
    }
});
