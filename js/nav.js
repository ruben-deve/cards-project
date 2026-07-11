const burgerBtn = document.getElementById('burgerBtn');
const mainNav = document.getElementById('mainNav');

// au clic sur le btn hamburger, on modifie la class 'nav-open' qui déclenche la modif CSS (main.css)
burgerBtn.addEventListener('click', () => {
    mainNav.classList.toggle('nav-open');
})