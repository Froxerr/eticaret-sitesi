function showMessages() {
    $('#contentPanel').hide();
    $('#kullanici_kayit_Panel').hide();
    $('#kullanici_giris_cikis_Panel').hide();
    $('#sepet_giris_Panel').hide();
    $('#messagePanel').show();
    $('#menu .list-group-item').removeClass('active');
    $('#messagesLink').addClass('active');
  }

  function showHome() {
    $('#messagePanel').hide();
    $('#kullanici_kayit_Panel').hide();
    $('#kullanici_giris_cikis_Panel').hide();
    $('#sepet_giris_Panel').hide();
    $('#contentPanel').show();
    $('#menu .list-group-item').removeClass('active');
    $('#homeLink').addClass('active');
  }

  function showKayitKontrol() {
    $('#messagePanel').hide();
    $('#kullanici_kayit_Panel').show();
    $('#kullanici_giris_cikis_Panel').hide();
    $('#sepet_giris_Panel').hide();
    $('#contentPanel').hide();
    $('#menu .list-group-item').removeClass('active');
    $('#kullanici_kayit_kontrol_Link').addClass('active');
  }
  function showKullaniciGiris() {
    $('#messagePanel').hide();
    $('#kullanici_kayit_Panel').hide();
    $('#kullanici_giris_cikis_Panel').show();
    $('#sepet_giris_Panel').hide();
    $('#contentPanel').hide();
    $('#menu .list-group-item').removeClass('active');
    $('#kullanici_giris_cikis_Link').addClass('active');
  }

  function showSepetGiris() {
    $('#messagePanel').hide();
    $('#kullanici_kayit_Panel').hide();
    $('#kullanici_giris_cikis_Panel').hide();
    $('#sepet_giris_Panel').show();
    $('#contentPanel').hide();
    $('#menu .list-group-item').removeClass('active');
    $('#sepet_giris_Link').addClass('active');
  }
  
  $('#homeLink').click(function() {
    showHome();
  });
  
  $('#messagesLink').click(function() {
    showMessages();
  });

  $('#kullanici_kayit_kontrol_Link').click(function() {
    showKayitKontrol();
  });
  $('#kullanici_giris_cikis_Link').click(function() {
    showKullaniciGiris();
  });
  $('#sepet_giris_Link').click(function() {
    showSepetGiris();
  });







  $('.message-content').click(function() {
    var message = $(this).data('message');
    $('#messageModalBody').text(message);
    $('#messageModal').modal('show');
  });