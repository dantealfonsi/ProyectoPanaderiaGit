// script.js
const notificationBell = document.querySelector('.notification-bell');
const notifications = document.querySelector('.notifications');

const getCookie = (nombre) => {
    const cookies = `; ${document.cookie}`;
    const cookiePartes = cookies.split(`; ${nombre}=`);
    if (cookiePartes.length === 2) {
        return cookiePartes.pop().split(';').shift();
    }
    return null;
};

//const miValorDeCookie = getCookie('IDusuario');
let mockNotifications;
notifications.style.display = 'none';

    fetch('http://localhost/ProyectoPanaderia/Modelo/server.php?vernotif=&IDusuario='+document.getElementById('sessionValue').value, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
        },
    })
    .then(response => response.json())
    .then(data => { 
        // Manejar los datos recibidos desde el backend        
        document.getElementById('numNotif').innerHTML = data.totalNotif;
        mockNotifications = data.noticias;
    })
    .catch(error => {
        console.error('Error al obtener datos:', error);
    });

// Muestra las notificaciones al hacer clic en la campana o al pasar el mouse sobre ella
notificationBell.addEventListener('click', () => {
    notifications.innerHTML = mockNotifications.map(notification => `<li>${notification}</li>`).join('');
    notifications.style.display = 'block';
});

notificationBell.addEventListener('click', () => {
    notifications.style.display = 'block';
});

notifications.addEventListener('mouseleave', () => {
    notifications.style.display = 'none';
});