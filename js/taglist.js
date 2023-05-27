    // Sélectionne les éléments de tag
    const tags = document.querySelectorAll('.tag');

    // Ajoute un gestionnaire d'évent au clic sur chaque tag
    tags.forEach(tag => {
        tag.addEventListener('click', () => {

            // Supprime la classe 'active' de tous les tags
            tags.forEach(tag => tag.classList.remove('active'));

            // Ajoute la classe 'active' au tag cliqué
            tag.classList.add('active');

            // Récupère le tag sélectionné
            const selectedTag = tag.getAttribute('data-tag');

            // Sélectionne les posts
            const posts = document.querySelectorAll('.post[data-tag]');

            // Affiche ou masque les posts en fonction du tag sélectionné
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



// Change la couleur des bordures des posts en fonction du tag sélectionné 
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
                borderColor = '#2ecc71';
                break;
            case 'Mode':
                borderColor = '#3498db';
                break;
            case 'Food':
                borderColor = '#f1c40f';
                break;
            case 'Travel':
                borderColor = '#9b59b6';
                break;
            case 'Beauty':
                borderColor = '#e74c3c';
                break
            case 'Sport':
                borderColor = '#1abc9c';
                break;
            case 'Tech':
                borderColor = '#27ae60';
                break;
            case 'Music':
                borderColor = '#2980b9';
                break;
            case 'Photography':
                borderColor = '#16a085';
                break;
            case 'Art':
                borderColor = '#d35400';
                break;    
            default:
                borderColor = '#808080';
        }
        $('.post').css('border-color', borderColor);
    }
});