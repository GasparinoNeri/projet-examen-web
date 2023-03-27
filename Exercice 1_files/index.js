let prenom = prompt('comment vous appelez-vous ?');
console.log(prenom);
let homme = confirm('Est ce que vous êtes un homme ?');
console.log(homme);
let civilite = null;

if (homme === true) {
    civilite = 'Monsieur';
}
else {
    civilite = 'Madame';
}
document.getElementById('welcom').className = 'alert alert-info';
document.getElementById('welcom').innerHTML = ' Bonjour ' + civilite + ' ' + prenom;
