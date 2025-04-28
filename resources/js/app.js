import './bootstrap';

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: "b105c86624515914c223",
    cluster: "eu",
    encrypted: true,
    forceTLS: true,
    authEndpoint: '/pusher/auth',
    auth: {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
    },
});





window.Echo.connector.pusher.connection.bind('connected', () => {
    console.log('Connected to Pusher');
});
window.Echo.connector.pusher.connection.bind('error', (error) => {
    console.error('Pusher connection error:', error);
});
// console.log('jjjjjjjjj');
// console.log(window.Echo);

