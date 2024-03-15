
var now = new Date();
var year = now.getFullYear();
var month = String(now.getMonth() + 1).padStart(2, '0'); // Ajoute un zéro devant le mois si nécessaire
var day = String(now.getDate()).padStart(2, '0'); // Ajoute un zéro devant le jour si nécessaire
var hours = String(now.getHours()).padStart(2, '0'); // Ajoute un zéro devant l'heure si nécessaire
var minutes = String(now.getMinutes()).padStart(2, '0'); // Ajoute un zéro devant les minutes si nécessaire
var datetimeString = year + '-' + month + '-' + day + ' ' + hours + ':' + minutes;
document.getElementById('dateHeureDebut').value = datetimeString;
