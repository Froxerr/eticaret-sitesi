$(document).ready(function () {
    // Sayfa yüklendiğinde sepet içeriğini kontrol et
    checkCartContent();

    // Storage event listener ekle
    window.addEventListener('storage', function(e) {
        if (e.key === 'cartUpdateTime') {
            updateCartFromStorage();
        }
    });

    // Sepet güncelleme işlemi
    $(document).on("click", ".update-cart-btn", function () {
        var productId = $(this).data("id");
        var quantity = $("#quantity_" + productId).val();

        // AJAX ile sepeti güncelleme
        $.ajax({
            url: "update_adet.php",
            method: "POST",
            data: { product_id: productId, quantity: quantity },
            success: function (response) {
                updateCartDisplay(response);
                // Sepet içeriğini güncelle
                updateCartStorage(response);
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", error);
            }
        });
    });

    // Sepet silme işlemi
    $(document).on("click", ".remove-cart-btn", function () {
        var productId = $(this).data("id");

        // AJAX ile sepetten ürünü kaldırma
        $.ajax({
            url: "remove_sepet.php",
            method: "POST",
            data: { product_id: productId },
            success: function (response) {
                updateCartDisplay(response);
                // Sepet içeriğini güncelle
                updateCartStorage(response);
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", error);
            }
        });
    });

    // Sepet içeriğini güncelle
    function updateCartDisplay(response) {
        var $offcanvasBody = $(".offcanvas-body");
        if (response.trim() === "" || response.includes("Sepet Boş")) {
            $offcanvasBody.html("<p class='container' id='cartContent'>Sepet Boş</p>");
            // LocalStorage'ı temizle
            localStorage.removeItem("cartContent");
            localStorage.removeItem("cartUpdateTime");
        } else {
            $offcanvasBody.html(response);
        }
    }

    // Sepet içeriğini localStorage'a kaydet
    function updateCartStorage(cartContent) {
        try {
            if (cartContent.trim() === "" || cartContent.includes("Sepet Boş")) {
                localStorage.removeItem("cartContent");
                localStorage.removeItem("cartUpdateTime");
            } else {
                localStorage.setItem("cartContent", cartContent);
                localStorage.setItem("cartUpdateTime", new Date().getTime());
            }
        } catch (e) {
            console.error("LocalStorage error:", e);
        }
    }

    // Storage'dan sepet içeriğini güncelle
    function updateCartFromStorage() {
        try {
            var savedCart = localStorage.getItem("cartContent");
            if (savedCart && !savedCart.includes("Sepet Boş")) {
                updateCartDisplay(savedCart);
            } else {
                updateCartDisplay("<p class='container' id='cartContent'>Sepet Boş</p>");
            }
        } catch (e) {
            console.error("LocalStorage read error:", e);
        }
    }

    // Sayfa yüklendiğinde sepet içeriğini kontrol et
    function checkCartContent() {
        updateCartFromStorage();
    }

    // Sepete ürün eklendiğinde
    $(document).on("cart:updated", function(e, cartContent) {
        updateCartDisplay(cartContent);
        updateCartStorage(cartContent);
    });

    // Cart button click event - tek seferlik bağlama
    var cartSidebar = null;
    $(document).on("click", ".cart-button", function(e) {
        e.preventDefault(); // Sayfanın yenilenmesini engelle
        if (!cartSidebar) {
            cartSidebar = new bootstrap.Offcanvas(document.getElementById('cartSidebar'));
        }
        cartSidebar.show();
    });

    // Ödeme tamamlandığında sepeti temizle
    window.addEventListener('message', function(event) {
        if (event.data === 'paymentComplete') {
            updateCartDisplay("<p class='container' id='cartContent'>Sepet Boş</p>");
            localStorage.removeItem("cartContent");
            localStorage.removeItem("cartUpdateTime");
        }
    });
});
