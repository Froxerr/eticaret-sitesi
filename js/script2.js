document.addEventListener('DOMContentLoaded', function () {
  const cartButton = document.querySelector('.cart-button');
  const cartSidebar = new bootstrap.Offcanvas(document.getElementById('cartSidebar'));

  cartButton.addEventListener('click', function (e) {
      e.preventDefault(); // Olayın varsayılan davranışını engelle
      cartSidebar.show(); // Offcanvas'i aç
  });
});