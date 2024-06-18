$(document).ready(function () {
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
                alert("Ürün adedi güncellendi.");
                $("#cartContent").html(response);
                // Sepet içeriğini güncelledikten sonra sessionStorage veya localStorage'da güncel sepet bilgisini saklayabiliriz
                sessionStorage.setItem("cart", JSON.stringify(response));

                location.reload();
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
                console.log(response);
                alert("Ürün sepetten silindi.");
                
                // Sepet içeriğini güncelledikten sonra sessionStorage veya localStorage'da güncel sepet bilgisini saklayabiliriz
                sessionStorage.setItem("cart", JSON.stringify(response));
                $("#cartContent").html(response);
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", error);
            }
        });
    });
});
