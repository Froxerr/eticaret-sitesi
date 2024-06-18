document.addEventListener('DOMContentLoaded', function() {
    const gif = document.getElementById('myGif');

    // GIF'i bir kez oynatmak için
    playGifOnce();

    function playGifOnce() {
        gif.style.display = 'block'; // GIF'i göster
        const currentSrc = gif.src;
        gif.src = ''; // GIF'i durdurmak için src'yi boş yap
        gif.src = currentSrc; // GIF'i yeniden yükleyerek oynat
    }
});