import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

const reverbKey = import.meta.env.VITE_REVERB_APP_KEY;
const reverbHost = import.meta.env.VITE_REVERB_HOST;

if (reverbKey && reverbHost) {
    window.Echo = new Echo({
        broadcaster: 'reverb',
        key: reverbKey,
        wsHost: reverbHost,
        wsPort: import.meta.env.VITE_REVERB_PORT ?? 8080,
        wssPort: import.meta.env.VITE_REVERB_PORT ?? 8080,
        forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'http') === 'https',
        enabledTransports: ['ws', 'wss'],
    });
}