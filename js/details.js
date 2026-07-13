const params = new URLSearchParams(window.location.search);
const idCarte = params.get('id');
const conteneurDetail = document.querySelector('main');

async function chargerDetailsPersonnage() {
    if(!idCarte){
        conteneurDetail.innerHTML = `<p>Aucune carte sélectionnée.</p>`;
    return;
    }

    try {
        const reponse = await fetch(`https://dragonball-api.com/api/characters/${idCarte}`);

        if (!reponse.ok){
            throw new Error(`Erreur serveur : ${reponse.status}`);
        }

        const perso = await reponse.json();
        afficherPersonnage(perso);
    }
    catch (erreur){
        conteneurDetail.innerHTML = `<p>Personnage introuvable.</p>`;
        console.error(erreur);
    }
}


function afficherPersonnage(perso) {
    conteneurDetail.innerHTML = `
    <article class="carte-detail">
        <img src="${perso.image}" alt="${perso.name}">
        <div class="carte-detail-infos">
            <h1>${perso.name}</h1>
            <p class="maison">${perso.race}</p>
            <p class="acteur">${perso.affiliation}</p>
            <p class="description">${perso.description}</p>
            <ul class="stats">
                <li><strong>Genre :</strong>${perso.gender}</li>
                <li><strong>Ki :</strong>${perso.ki}</li>
                <li><strong>Ki max :</strong>${perso.maxKi}</li>
            </ul>
        </div>
    </article>
    `;
}

chargerDetailsPersonnage();