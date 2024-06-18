$(document).ready(function () {
  $('.custom-search-input').on('focus', function() {
    $('.scrollable-list').fadeIn(300);
    $('.scrollable-list').css({
        'max-width': '700px', // Scrollable list genişliğini artırın
        'max-height': '200px'
    });

    $('.list-group-item').addClass('expanded'); // list-group-item'ları genişletin
});

$('.custom-search-input').on('blur', function() {
  $('.scrollable-list').fadeOut(300); // Scrollable list gizle
    $('.scrollable-list').css({
        'max-width': '200px', // Başlangıç genişliğine dönün
        'max-height': '200px'
    });

    $('.list-group-item').removeClass('expanded'); // list-group-item'ları küçültün
});


  // Send Search Text to the server
  $("#search").keyup(function () {
    let searchText = $(this).val();
    if (searchText != "") {
      $.ajax({
        url: "../php/action.php",
        method: "post",
        data: {
          query: searchText,
        },
        success: function (response) {
          
          $("#show-list").html(response);
        },
      });
    } else {
      $("#show-list").html("");
    }
  
  });
  // Set searched text in input field on click of search button
  $(document).on("click", "a", function () {
    $("#search").val($(this).text());
    $("#show-list").html("");
  });

  
  // openModalButton butonuna tıklandığında modalı göster
  $('#openModalButton').click(function() {
    $('#userInfoModal').modal('show');
});

// exitButton butonuna tıklandığında çıkış işlemi yap
$('#exitButton').click(function() {
    $.ajax({
        url: 'logout.php',
        type: 'POST',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                alert('Çıkış yapıldı!');
                $('#userInfoModal').modal('hide');
                window.location.href = 'index.php';
            } else {
                alert('Çıkış yapılamadı.');
            }
        },
        error: function(xhr, status, error) {
            alert('Bir hata oluştu. Tekrar deneyin.');
        }
    });
});

});


