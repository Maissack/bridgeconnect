// Affichage du modal de demande de co si y'a scroll
$(window).scroll(function() {
    // Si l'utilisateur n'est pas co
    if (!userIsLogged) {
        if ($(this).scrollTop() > 0) {
            $('body').addClass('blur-effect');
            // Affichez le modal de connexion / inscription
            $('#loginModal').modal('show');
        }
    }
});

$('#loginModal').on('show.bs.modal', function() {
    $('body').addClass('modal-open');
});

$('#loginModal').on('hide.bs.modal', function() {
    $('body').removeClass('modal-open');
});



// Affichage du modal de demande de co si y'a mouv du curseur
$(window).mousemove(function() {
    // Si l'utilisateur n'est pas co
    if (!userIsLogged) {
        $('body').addClass('blur-effect');
        // Affichez le modal de connexion / inscription
        $('#loginModal').modal('show');
    }
});

$('#loginModal').on('show.bs.modal', function() {
    $('body').addClass('modal-open');
});

$('#loginModal').on('hide.bs.modal', function() {
    $('body').removeClass('modal-open');
});





