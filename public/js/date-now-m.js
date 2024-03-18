

var now = new Date();
var nextMonth = new Date(now.getFullYear(), now.getMonth() + 1, now.getDate());
var formattedDate = nextMonth.toISOString().split('T')[0];
document.getElementById('dateLimiteInscription').value = formattedDate;
