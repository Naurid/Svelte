export function sendXHR(url, data = {}) {
    return new Promise((resolve, reject) => {
        var xhr = new XMLHttpRequest();

        // Encoder les données en format "application/x-www-form-urlencoded"
        var params = Object.keys(data).map(function(key) {
            return encodeURIComponent(key) + '=' + encodeURIComponent(data[key]);
        }).join('&');

        xhr.open('POST', 'http://localhost:8080' + url, true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {
                resolve(xhr.responseText);  // Résoudre la promesse avec la réponse
            } else {
                reject('Erreur de requête. Statut : ' + xhr.status);  // Rejeter la promesse en cas d'erreur HTTP
            }
        };

        xhr.onerror = function() {
            reject("Erreur réseau");  // Rejeter la promesse en cas d'erreur réseau
        };

        // Envoyer les paramètres encodés
        xhr.send(params);
    });
}

export function sendXHRForCreation(url, data) {
    return new Promise((resolve, reject) => {
      const xhr = new XMLHttpRequest();
      xhr.open('POST', 'http://localhost:8080' + url, true);
      
      // Set the content type to application/json
      xhr.setRequestHeader('Content-Type', 'application/json'); 
      
      xhr.onload = function () {
        if (xhr.status >= 200 && xhr.status < 300) {
          resolve(JSON.parse(xhr.responseText));  // Parse the response as JSON
        } else {
          reject('Error: ' + xhr.status);
        }
      };
  
      xhr.onerror = function () {
        reject("Network Error");
      };
  
      // Convert the data object to a JSON string
      xhr.send(JSON.stringify(data));
    });
  }
  