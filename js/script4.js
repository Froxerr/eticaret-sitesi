document.addEventListener('DOMContentLoaded', function() {
  const inputFields = document.querySelectorAll('.iletisim_input');

  inputFields.forEach(function(inputField) {
      const bottomLine = inputField.nextElementSibling;

      inputField.addEventListener('input', function() {
          if (inputField.value.trim() === '') {
              bottomLine.classList.add('input-error');
          } else {
              bottomLine.classList.remove('input-error');
          }
      });

      inputField.addEventListener('blur', function() {
          if (inputField.value.trim() === '') {
              bottomLine.classList.add('input-error');
          } else {
              bottomLine.classList.remove('input-error');
              bottomLine.classList.add('input-success');
          }
      });
  });
});
