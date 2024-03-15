
document.addEventListener('DOMContentLoaded', function() {
    creationLieu('lieuExistant','nouveauLieu');
});

function creationLieu(afficher, cacher ) {
    var divAfficher = document.getElementById(afficher);
    var divCacher = document.getElementById(cacher);
        divAfficher.style.display = 'block';
        divCacher.style.display = 'none'

        var inputsCache = divCacher.getElementsByTagName('input');
        var selectsCache = divCacher.getElementsByTagName('select');
        for (var i = 0; i < inputsCache.length; i++) {
            inputsCache[i].disabled = true
        }
        for (var j = 0; j < selectsCache.length; j++) {
            selectsCache[j].disabled = true
        }

        var inputsAffiche = divAfficher.getElementsByTagName('input');
        var selectsAffiche = divAfficher.getElementsByTagName('select');
        for (var i = 0; i < inputsAffiche.length; i++) {
            inputsAffiche[i].disabled = false;
        }
        for (var j = 0; j < selectsAffiche.length; j++) {
            selectsAffiche[j].disabled = false;
        }


}
