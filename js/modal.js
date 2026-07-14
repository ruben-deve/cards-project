const ouvrirModalBtn = document.getElementById('ouvrirModal');
const fermerModalBtn = document.getElementById('fermerModal');
const modalOverlay = document.getElementById('modalOverlay');
const formEchange = document.getElementById('formEchange');

// ouverture
ouvrirModalBtn.addEventListener('click', () => {
    modalOverlay.classList.add('modal-visible');
});

// fermeture (croix)
fermerModalBtn.addEventListener('click', () => {
    modalOverlay.classList.remove('modal-visible');
});

// fermeture clic en dehors 
modalOverlay.addEventListener('click', () => {
    if(event.target === modalOverlay) {
        modalOverlay.classList.remove('modal-visible');
    }
});

// soumission form
formEchange.addEventListener('submit', (event) => {
    event.preventDefault();
    console.log("Échange effectué");
    modalOverlay.classList.remove('modal-visible');

})