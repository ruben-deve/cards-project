const URL_API = 'https://dragonball-api.com/api/characters?limit=58';
const conteneurCartes = document.querySelector('.cartes-liste');
const conteneurFiltres = document.querySelector('.filtres-maison');
const couleursParRace = {};

// calcule une couleur pour chaque race
function genererCouleursPourRaces(racesUniques) {
  const nombreDeRaces = racesUniques.length;

  racesUniques.forEach((race, index) => {
    const teinte = Math.round((360 / nombreDeRaces) * index);
    couleursParRace[race] = `hsl(${teinte}, 65%, 55%)`;
  });
}

function obtenirCouleur(race) {
  return couleursParRace[race];
}

// chargement des personnages via l'API
async function chargerPersonnages() {
  try {
    const reponse = await fetch(URL_API);

    if (!reponse.ok) {
      throw new Error(`Erreur serveur : ${reponse.status}`);
    }

    const donnees = await reponse.json();
    const personnages = donnees.items; 

    genererFiltres(personnages);
    genererCartes(personnages);

    document.dispatchEvent(new CustomEvent('filtresGeneres'));

  } catch (erreur) {
    conteneurCartes.innerHTML = `<p>Impossible de charger les personnages. Réessaie plus tard.</p>`;
    console.error(erreur);
  }
}


// gestion du filtre des personnages par race
function genererFiltres(personnages) {
  const racesUniques = [...new Set(personnages.map((p) => p.race))];

  genererCouleursPourRaces(racesUniques);

  racesUniques.forEach((race) => {
    const btn = document.createElement('button');
    btn.classList.add('filtre-btn');
    btn.dataset.maison = race;
    btn.textContent = race;
    conteneurFiltres.appendChild(btn);
  });

  const resetBtn = document.createElement('button');
  resetBtn.id = 'resetFiltre';
  resetBtn.textContent = 'Tout afficher';
  conteneurFiltres.appendChild(resetBtn);
}


function genererCartes(personnages) {
  personnages.forEach((perso) => {
    const article = document.createElement('article');
    article.classList.add('carte');
    article.dataset.maison = perso.race;

    article.innerHTML = `
      <button class="favori-btn" aria-label="Ajouter aux favoris">♥</button>
      <a href="carte-details.php?id=${perso.id}">
        <img src="${perso.image}" alt="${perso.name}">
        <h3>${perso.name}</h3>
        <p class="maison">${perso.race}</p>
        <p class="acteur">${perso.affiliation}</p>
      </a>
    `;
    conteneurCartes.appendChild(article);
  });

  // on prévient le reste de la page que les cartes sont prêtes
  document.dispatchEvent(new CustomEvent('cartesChargees'));
}

chargerPersonnages();