const filtreBtns = document.querySelectorAll('.filtre-btn');
const resetBtn = document.getElementById('resetFiltre');
const allCards = document.querySelectorAll('.carte');

const couleursMaison = {
    maison1 : '#7f0909',
    maison2: "#1a472a",
    maison3: "#ecb939",
    maison4: "#0e1a40"
};

filtreBtns.forEach((btn) => {
    btn.addEventListener('click', () => {
        const maisonChoisie = btn.dataset.maison;
        filtreBtns.forEach((b) => b.classList.remove('filtre-active'));
        btn.classList.add('filtre-active');
        document.documentElement.style.setProperty('--color-accent', couleursMaison[maisonChoisie]);
        
        // affiche ou masque la carte selon la maison
        allCards.forEach((carte) => {
            if(carte.dataset.maison === maisonChoisie){
                carte.classList.remove('carte-masquee');
            } else {
                carte.classList.add('carte-masquee');
            }
        });
    });
});

// btn 'tout afficher' : réinitialise le filtre
resetBtn.addEventListener('click', () => {
    filtreBtns.forEach((b) => b.classList.remove('filtre-active'));
    allCards.forEach((carte) => carte.classList.remove('carte-masquee'));
    document.documentElement.style.removeProperty('--color-accent');
})