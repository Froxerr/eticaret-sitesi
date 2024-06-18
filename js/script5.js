document.addEventListener('DOMContentLoaded', function() {
    const expandButtons = document.querySelectorAll('.expand-button');
    const contents = document.querySelectorAll('.content');

    expandButtons.forEach((button, index) => {
        button.addEventListener('click', function() {
            // Kutu içeriklerini döngüyle kontrol et
            contents.forEach((content, idx) => {
                if (index === idx) {
                    content.classList.toggle('active');
                    button.textContent = content.classList.contains('active') ? '-' : '+';
                    button.style.color = content.classList.contains('active') ? 'red' : 'black';
                } else {
                    content.classList.remove('active');
                    expandButtons[idx].textContent = '+';
                    expandButtons[idx].style.color = 'black';
                }
            });
        });
    });
});
