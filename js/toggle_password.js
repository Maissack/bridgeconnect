// Afficher le mot de passe (pour la page d'inscription):

function togglePassword() {
    const passwordInput = document.querySelector('input[name="mot_de_passe"]');
    const toggleIcon = document.querySelector('.toggle-password img');

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleIcon.src = "https://img.icons8.com/ios-filled/24/000000/invisible.png";
    } else {
        passwordInput.type = "password";
        toggleIcon.src = "https://img.icons8.com/ios-filled/24/000000/visible.png";
    }
}




    





