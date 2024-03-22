
var lieu = window.lieux
var ville = window.ville
var sortie = window.sortie
if (typeof sortie === "undefined") {
    console.log("La variable existe.");
}

/*
    Affiche les différents lieux présent dans la bdd, suivant la ville selectionné
 */
function updateLieux() {
    var villeSelect = document.getElementById('ville');
    var codePostalVilleSelected = document.getElementById('codePostal')
    var lieuSelect = document.getElementById('lieu');
    var selectedVilleId = villeSelect.value
    lieuSelect.innerHTML = '';

    // Trouver le nom de la  ville sélectionné
    for (var i = 0; i < ville.length; i++) {
        selectedVilleId = parseInt(selectedVilleId)
        if (ville[i].id === selectedVilleId) {

            codePostalVilleSelected.innerText ='Code Postal : ' + ville[i].codePostal
        }
    }

    var lieuxDeLaVille = lieu.filter(function(lieu) {
        return lieu.ville_id == selectedVilleId;
    });

    lieuxDeLaVille.forEach(function(lieu) {
        addOption(lieuSelect, lieu.nom, lieu.id);
    });


    updateDonneeLieu();
}

/*
    Affiches les différente donnée du lieu suivant le liue selectionné
 */
function updateDonneeLieu() {
    var lieuSelect = document.getElementById('lieu');
    var selectedLieuId = lieuSelect.value;
    var rueParagraph = document.getElementById('rue');
    var longitudeParagraph = document.getElementById('longitude');
    var latitudeParagraph = document.getElementById('latitude');

    // Trouver le lieu sélectionné
    var selectedLieu = lieu.find(function(lieu) {
        return lieu.id == selectedLieuId;
    });

    // Afficher les données du lieu selectionné
    if (selectedLieu) {
        rueParagraph.innerText = 'Rue : ' + selectedLieu.rue ;
        longitudeParagraph.innerText = 'Longitude : ' + selectedLieu.longitude + '°';
        latitudeParagraph.innerText = 'Latitude : ' + selectedLieu.latitude + '°';
    } else {
        rueParagraph.innerText = 'Données inconnue';
    }
}

// Fonction pour ajouter une option à un élément select
function addOption(selectElement, text, value) {
    var option = document.createElement('option');
    option.text = text;
    option.value = value;
    if(typeof sortie !== "undefined" && value === sortie.lieu_id){
        option.selected = true
    }
    selectElement.add(option);
}


// Mettre à jour les options initiales
updateLieux();
