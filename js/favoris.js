// On attend que les cartes soient réellement créées avant de chercher les boutons
document.addEventListener('cartesChargees', () => {
  const favoriBtns = document.querySelectorAll('.favori-btn');

  favoriBtns.forEach((btn) => {
    btn.addEventListener('click', (event) => {
      event.preventDefault();
      btn.classList.toggle('favori-active');
    });
  });
});