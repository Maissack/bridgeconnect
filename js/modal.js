// Après le chargement du document
document.addEventListener('DOMContentLoaded', function() {

    // Vérifie s'il y a quelque chose dans le localStorage
    if(localStorage.getItem("brouillonMessage")) {
        document.querySelector('textarea[name="message"]').value = localStorage.getItem("brouillonMessage");
    }

    if(localStorage.getItem("brouillonTag")) {
        document.querySelector('select[name="tag"]').value = localStorage.getItem("brouillonTag");
    }

    if(localStorage.getItem("brouillonPseudo")) {
        document.querySelector('input[name="pseudo"]').value = localStorage.getItem("brouillonPseudo");
    }

    // Lorsque l'utilisateur commence à taper ou change le tag
    document.querySelector('textarea[name="message"]').addEventListener('input', function() {
        // Sauvegarde le message dans le localStorage
        localStorage.setItem("brouillonMessage", this.value);
    });

    document.querySelector('select[name="tag"]').addEventListener('change', function() {
        // Sauvegarde le tag dans le localStorage
        localStorage.setItem("brouillonTag", this.value);
    });

    document.querySelector('input[name="pseudo"]').addEventListener('input', function() {
        // Sauvegarde le pseudo dans le localStorage
        localStorage.setItem("brouillonPseudo", this.value);
    });

    // Lorsque l'utilisateur soumet le formulaire
    document.querySelector('#postForm').addEventListener('submit', function() {
        // Efface le localStorage
        localStorage.removeItem("brouillonMessage");
        localStorage.removeItem("brouillonTag");
        localStorage.removeItem("brouillonPseudo");
    });
});
