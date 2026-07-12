// gestion champ de recherche
const rechercheInput = document.getElementById('rechercheInput');
const cartesRecherche = document.querySelectorAll('.carte');

rechercheInput.addEventListener('input', () => {
    const texteRecherche = rechercheInput.value.toLowerCase();

    cartesRecherche.forEach((carte) => {
        const nomCarte = carte.querySelector('h3').textContent.toLowerCase();

        if(nomCarte.includes(texteRecherche)) {
            carte.classList.remove('carte-masquee');
        } else {
            carte.classList.add('carte-masquee');
        }
    });
});