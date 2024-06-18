let lastScrollTop = 0;
const navbar = document.querySelector('.navbar');

window.addEventListener('scroll', function() {
  let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
  
  if (scrollTop > lastScrollTop) {
    // Aşağı kaydırma durumu
    navbar.classList.add('hidden');
  } else {
    // Yukarı kaydırma durumu
    navbar.classList.remove('hidden');
  }
  
  lastScrollTop = scrollTop;
});
