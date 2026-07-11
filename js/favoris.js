// tous les btns favoris de la page
const favoriBtns = document.querySelectorAll('.favori-btn');

// boucle sur chaque btn pour ajouter un listener
favoriBtns.forEach((btn) => {
    btn.addEventListener('click', () => {
        btn.classList.toggle('favori-active');
    });
});