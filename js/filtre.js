function initialiserFiltres() {
    const boutonsFiltre = document.querySelectorAll(".filtre-btn");
    const cartes = document.querySelectorAll(".carte");

    if (boutonsFiltre.length === 0 || cartes.length === 0) {
        return;
    }

    boutonsFiltre.forEach(bouton => {
        bouton.addEventListener("click", () => {
            const race = bouton.dataset.race;

            boutonsFiltre.forEach(btn => {
                btn.classList.remove("filtre-active");
            });

            bouton.classList.add("filtre-active");

            cartes.forEach(carte => {
                carte.style.display =
                    race === "toutes" || carte.dataset.race === race
                        ? "block"
                        : "none";
            });
        });
    });
}

// pour profil.php
initialiserFiltres();

// pour index.php
document.addEventListener("filtresGeneres", initialiserFiltres);