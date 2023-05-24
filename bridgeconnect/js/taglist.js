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