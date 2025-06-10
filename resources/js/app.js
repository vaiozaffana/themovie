import './bootstrap';
import Alpine from 'alpinejs';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import heroParticles from './components/heroParticles';
import neonText from './components/neonText';
import typingAnimation from './components/typingAnimation';

gsap.registerPlugin(ScrollTrigger);

window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    heroParticles();
    neonText();
    typingAnimation();

    gsap.from("#feature-cards > canvas", {
        scrollTrigger: {
            trigger: "#feature-cards",
            start: "top 80%",
            toggleActions: "play none none none"
        },
        y: 50,
        opacity: 0,
        duration: 0.8,
        stagger: 0.2,
        ease: "power2.out"
    });


    const exploreBtn = document.getElementById('explore-button');
    exploreBtn.addEventListener('click', () => {
        gsap.to(exploreBtn, {
            scale: 0.9,
            duration: 0.1,
            yoyo: true,
            repeat: 1
        });
    });
});
