// gestion champ de recherche
document.addEventListener('cartesChargees', () => {
    const rechercheInput = document.getElementById('rechercheInput');
    rechercheInput.addEventListener('input', () => {
        const texteRecherche = rechercheInput.value.toLowerCase();
        const cartesRecherche = document.querySelectorAll('.carte');
        cartesRecherche.forEach((carte) => {
            const nomCarte = carte.querySelector('h3').textContent.toLowerCase();
            carte.classList.toggle(
                'carte-masquee',
                !nomCarte.includes(texteRecherche)
            );
        });
    });
});