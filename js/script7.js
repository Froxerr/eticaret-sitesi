const priceSlider = document.getElementById('price-slider');
const minValueInput = document.getElementById('minValueInput');
const maxValueInput = document.getElementById('maxValueInput');
const productList = document.getElementById('product-list');
const priceDetails = document.querySelector('.price-details');
const toggleSliderBtn = document.getElementById('toggleSlider');
const minPriceSpan = document.getElementById('minValue');
    const maxPriceSpan = document.getElementById('maxValue');
let sliderShown = false;

function updateProductCount() {
    const products = document.querySelectorAll('.product');
    const visibleProducts = Array.from(products).filter(product => product.style.display !== 'none');
    const productCountElement = document.getElementById('productCount');
    productCountElement.textContent = `${visibleProducts.length} ürün`;

    if (visibleProducts.length === 0) {
        productCountElement.textContent = "Aradığınız nitelikte ürün bulamadık";
    } else {
        productCountElement.textContent = `${visibleProducts.length} ürün`;
    }
}

noUiSlider.create(priceSlider, {
    start: [0, 400],  // Başlangıç değerleri
    connect: true,
    range: {
        'min': 0,
        'max': 400
    }
});

// Slider değerleri değiştikçe
// Slider değerleri değiştikçe
priceSlider.noUiSlider.on('update', function(values, handle) {
    const minValue = Math.round(values[0]);
    const maxValue = Math.round(values[1]);

    // Input değerlerini ve görsel olarak gösterilen minimum-maximum değerleri güncelle
    minValueInput.value = minValue;
    maxValueInput.value = maxValue;
    minPriceSpan.textContent = minValue;
    maxPriceSpan.textContent = maxValue;

    // Ürünleri filtrele ve güncelle
    filterProducts(minValue, maxValue);
    updateProductCount();
});


toggleSliderBtn.addEventListener('click', function() {
    sliderShown = !sliderShown;
    if (sliderShown) {
        priceSlider.style.display = 'block';
        priceDetails.style.display = 'block';
        setTimeout(() => {
            priceSlider.style.maxHeight = '200px'; // Adjust based on your actual content
            priceSlider.style.opacity = '1';
            priceSlider.style.marginTop = '20px'; // Added margin-top
            priceDetails.style.maxHeight = '100px'; // Adjust based on your actual content
            priceDetails.style.opacity = '1';
            priceDetails.style.marginTop = '10px'; // Added margin-top
        }, 10);
        toggleSliderBtn.textContent = '-';
        minValue.textContent = Math.round(priceSlider.noUiSlider.get()[0]);
        maxValue.textContent = Math.round(priceSlider.noUiSlider.get()[1]);
    } else {
        priceSlider.style.maxHeight = '0';
        priceSlider.style.opacity = '0';
        priceSlider.style.marginTop = '0';
        priceDetails.style.maxHeight = '0';
        priceDetails.style.opacity = '0';
        priceDetails.style.marginTop = '0';
        toggleSliderBtn.textContent = '+';
        setTimeout(() => {
            priceSlider.style.display = 'none';
            priceDetails.style.display = 'none';
        }, 500);
    }
});

// Ürünleri filtreleyen fonksiyon
function filterProducts(minValue, maxValue) {
    const products = document.querySelectorAll('.product');
    products.forEach(product => {
        const priceElement = product.querySelector('.product-description');
        const price = parseFloat(priceElement.textContent.replace(' ₺', '').replace(',', '.'));

        if (price >= minValue && price <= maxValue) {
            product.style.display = 'block';
        } else {
            product.style.display = 'none';
        }
    });

}
