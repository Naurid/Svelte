export function sendXHR(url, data = {}, event) {
    
    
    return new Promise((resolve, reject) => {
        var xhr = new XMLHttpRequest();
        var formData;
        // Encoder les données du paramètre `data` en format "application/x-www-form-urlencoded"
        if (event) {
            formData = new FormData(event.target.closest('form'));
        }else{
            formData = new FormData();
        }
       
        console.log(formData.entries() );
        for (const key in data) {
            if (Object.prototype.hasOwnProperty.call(data, key)) {
                var value = data[key];
                if (typeof value == 'object') {
                    value=JSON.stringify(value);
                }
                formData.append(key, value);
            }
        }

        // Initialiser la requête avec la méthode POST
        xhr.open('POST', 'http://localhost:8080' + url, true);

        // Définir ce qui se passe lorsque la requête est terminée avec succès
        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {
                resolve(xhr.responseText);  // Résoudre la promesse avec la réponse
            } else {
                reject('Erreur de requête. Statut : ' + xhr.status);  // Rejeter en cas de statut HTTP d'erreur
            }
        };

        // Définir ce qui se passe en cas d'erreur réseau
        xhr.onerror = function() {
            reject("Erreur réseau");  // Rejeter la promesse en cas de problème de réseau
        };

        // Envoyer les paramètres encodés dans le corps de la requête POST
        xhr.send(formData);
    });
}
