attachEventHandlers();
const productImage = document.getElementById('productImage');
    const thumbnails = document.querySelectorAll('.thumbnail');


    thumbnails.forEach(thumbnail => {
        thumbnail.addEventListener('click', function() {
            const newImageSrc = this.getAttribute('data-image');
            productImage.src = newImageSrc;
        });
    });

    const productImageContainer = document.querySelector('.product-image-container');

    productImageContainer.addEventListener('mousemove', function (e) {
        const rect = productImageContainer.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        const xPercent = (x / rect.width) * 100;
        const yPercent = (y / rect.height) * 100;

        productImage.style.transformOrigin = `${xPercent}% ${yPercent}%`;
        productImage.classList.add('zoomed');
    });

    productImageContainer.addEventListener('mouseleave', function () {
        productImage.classList.remove('zoomed');
    });


    $(".add-to-cart").click(function () {
        var productId = $(this).data("product");
        var quantity = $(".number-input").val();
        $.ajax({
            url: "sepet_ekle.php",
            method: "POST",
            data: { product_id: productId, quantity: quantity },
            success: function (response) {
                $("#cartContent").html(response);
                $('#cartSidebar').offcanvas('show');
                attachEventHandlers(); // Event handlers yeniden bağlanmalı
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", error);
            }
        });
    });

    function attachEventHandlers() {
        $(".update-cart-btn").off("click").on("click", function () {
            var productId = $(this).data("id");
            var quantity = $("#quantity_" + productId).val();
            updateCart(productId, quantity);
        });

        $(".remove-cart-btn").off("click").on("click", function () {
            var productId = $(this).data("id");
            removeCart(productId);
        });
    }

    function updateCart(productId, quantity) {
        $.ajax({
            url: "update_adet.php",
            method: "POST",
            data: { product_id: productId, quantity: quantity },
            success: function (response) {
                alert("Ürün adedi güncellendi.");
                $("#cartContent").html(response);
                // Sepet içeriğini güncelledikten sonra sessionStorage veya localStorage'da güncel sepet bilgisini saklayabiliriz
                sessionStorage.setItem("cart", JSON.stringify(response));
                attachEventHandlers(); // Event handlers yeniden bağlanmalı
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", error);
            }
        });
    }

    function removeCart(productId) {
        $.ajax({
            url: "remove_sepet.php",
            method: "POST",
            data: { product_id: productId },
            success: function (response) {
                alert("Ürün sepetten silindi.");
                $("#cartContent").html(response);
                // Sepet içeriğini güncelledikten sonra sessionStorage veya localStorage'da güncel sepet bilgisini saklayabiliriz
                sessionStorage.setItem("cart", JSON.stringify(response));
                attachEventHandlers(); // Event handlers yeniden bağlanmalı
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", error);
            }
        });
    }