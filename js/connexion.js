// gestion email dans le localStorage
const emailInput = document.getElementById('emailInput');

const emailSave = localStorage.getItem('email');
if(emailSave){ 
    emailInput.value = emailSave
}

emailInput.addEventListener('input', () => {
    localStorage.setItem('email', emailInput.value)
});