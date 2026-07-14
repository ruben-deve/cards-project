const boutonsFiltre = document.querySelectorAll(".filtre-btn");
const cartes = document.querySelectorAll(".carte");


boutonsFiltre.forEach(bouton => {

    bouton.addEventListener("click", () => {

        const race = bouton.dataset.race;


        boutonsFiltre.forEach(btn => {
            btn.classList.remove("filtre-active");
        });

        bouton.classList.add("filtre-active");


        cartes.forEach(carte => {

            if (
                race === "toutes" ||
                carte.dataset.race === race
            ) {
                carte.style.display = "block";
            } else {
                carte.style.display = "none";
            }

        });

    });

});