// Récupérer le formulaire
const postForm = document.getElementById('postForm');
// Récupérer les éléments du formulaire
const postMessageInput = document.getElementById('postMessage');
const postTagSelect = document.getElementById('postTag');

// Vérifier si des données non publiées sont stockées dans le localStorage
const storedMessage = localStorage.getItem('unsavedMessage');
const storedTag = localStorage.getItem('unsavedTag');

if (storedMessage && storedTag) {
    // Remettre les données non publiées dans les champs du formulaire
    postMessageInput.value = storedMessage;
    postTagSelect.value = storedTag;
}

// Ajouter un écouteur d'événement sur la soumission du formulaire
postForm.addEventListener('submit', function (event) {
    event.preventDefault();

    // Récupérer les valeurs des champs
    const pseudo = postForm.pseudo.value;
    const message = postMessageInput.value;
    const tag = postTagSelect.value;

    // Stocker les données non publiées dans le localStorage
    localStorage.setItem('unsavedMessage', message);
    localStorage.setItem('unsavedTag', tag);

    // Envoyer les données au serveur pour l'enregistrement en base de données
    fetch('save_post.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            pseudo: pseudo,
            message: message,
            tag: tag
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log('Post saved successfully:', data);
        // Réinitialiser les données du formulaire
        postForm.reset();
        localStorage.removeItem('unsavedMessage');
        localStorage.removeItem('unsavedTag');
    })
    .catch(error => {
        console.error('Error saving post:', error);
    });
});