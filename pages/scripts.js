let cartBtn = document.querySelector(".cart-btn");
let cart= document.querySelector(".cart-container");

cartBtn.onclick = () => {
cart.classList.add("active");
}



document.addEventListener('DOMContentLoaded', function() {
    const expiryDateField = document.getElementById('expiryDate');
    const expiryDateError = document.getElementById('expiryDateError');
  
    expiryDateField.addEventListener('input', function() {
      const enteredValue = this.value;
      const isValid = /^(0[1-9]|1[0-2])\/\d{2}$/.test(enteredValue);
  
      if (isValid) {
        const month = parseInt(enteredValue.split('/')[0], 10);
        if (month >= 1 && month <= 12) {
          expiryDateError.textContent = '';
        } else {
          expiryDateError.textContent = 'Please enter a valid month (01-12)';
        }
      } else {
        expiryDateError.textContent = 'Please enter a valid MM/YY date format';
      }
    });
  });
  