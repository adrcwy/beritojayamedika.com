import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// AOS
import AOS from 'aos';
import 'aos/dist/aos.css';

AOS.init({
    duration: 500,
    once: true,
});