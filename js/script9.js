$(document).ready(function() {
    $('#myForm').on('submit', function(event) {
        event.preventDefault();

        $.ajax({
            type: 'POST',
            url: 'kontrol_giris.php',
            data: $(this).serialize(),
            success: function(response) {
                if (response.success) {
                    alert('Başarılı bir şekilde giriş yaptınız!');

                    // 3 saniye sonra yönlendirme
                    setTimeout(function() {
                        window.location.href = 'index.php';
                    }, 1000);
                } else {
                    alert(response.message);
                }
            },
            error: function() {
                alert('Bir hata oluştu. Lütfen tekrar deneyin.');
            }
        });
    });
});