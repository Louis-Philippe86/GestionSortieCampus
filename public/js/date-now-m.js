
// Récupérer la date actuelle
var now = new Date();


var nextMonth = new Date(now.getFullYear(), now.getMonth() + 1, now.getDate());

// Formatter la date pour l'attribut value
var formattedDate = nextMonth.toISOString().split('T')[0]; // Format ISO (YYYY-MM-DD)

// Définir la valeur du champ de saisie de date
document.getElementById('dateLimiteInscription').value = formattedDate;
