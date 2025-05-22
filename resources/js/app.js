import './bootstrap';
import Alpine from 'alpinejs'


window.Alpine = Alpine
Alpine.start()

function startContainer(name) {
    fetch('http://dockerctl:3000/start', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ container: name }),
    })
    .then(response => response.json())
    .then(data => console.log('Start OK', data))
    .catch(error => console.error('Erro:', error));
}
