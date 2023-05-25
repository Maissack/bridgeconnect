    // Sélection des éléments de tag
    const tags = document.querySelectorAll('.tag');

    // Ajout d'un gestionnaire d'événement au clic sur chaque tag
    tags.forEach(tag => {
        tag.addEventListener('click', () => {
            // Suppression de la classe "active" de tous les tags
            tags.forEach(tag => tag.classList.remove('active'));

            // Ajout de la classe "active" au tag cliqué
            tag.classList.add('active');

            // Récupération du tag sélectionné
            const selectedTag = tag.getAttribute('data-tag');

            // Sélection des messages/posts
            const posts = document.querySelectorAll('.post[data-tag]');


            // Affichage/ masquage des messages/posts en fonction du tag sélectionné
            posts.forEach(post => {
                const postTag = post.getAttribute('data-tag');
                if (selectedTag === 'all' || postTag === selectedTag) {
                    post.style.display = 'block';
                } else {
                    post.style.display = 'none';
                }
            });
        });
    });





// Le bouton 'All' sera cliqué lorsque la page se reload
$(window).on('load', function() {
    $('.tag[data-tag="all"]').click();
});


// Changement de couleur des bordures des posts en fonction du tag sélectionné 
let allClicked = false;

$(".tag").click(function() {
    const tag = $(this).data("tag");

    if (tag === "all") {
        if (!allClicked) {
            allClicked = true;
            $('.post').css('border-color', 'grey');
        }
    } else {
        allClicked = false;
    
        let borderColor;
        switch(tag) {
            case 'Nature':
                borderColor = 'green';
                break;
            case 'Mode':
                borderColor = 'blue';
                break;
            case 'Food':
                borderColor = 'brown';
                break;
            case 'Travel':
                borderColor = 'brown';
                break;
            case 'Beauty':
                borderColor = 'white';
                break
            case 'Sport':
                borderColor = 'green';
                break;
            case 'Tech':
                borderColor = 'blue';
                break;
            case 'Music':
                borderColor = 'brown';
                break;
            case 'Photography':
                borderColor = 'brown';
                break;
            case 'Art':
                borderColor = 'brown';
                break;    
            default:
                borderColor = 'grey';
        }
        $('.post').css('border-color', borderColor);
    }
});