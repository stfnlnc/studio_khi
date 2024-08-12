import {gsap} from "gsap";

export function preloader() {
    const preloader = document.querySelector('.preloader')
    const preloaderIcon = document.querySelector('.preloader__icon')
    const preloaderText = document.querySelector('.preloader__text')
    if(preloader) {
        gsap.to(preloaderIcon, {
            x: 0,
            y: 0,
            duration: 0.8,
            opacity: 1,
            ease: 'power2.out'
        })
        gsap.to(preloaderText, {
            y: 0,
            duration: 0.8,
            opacity: 1,
            ease: 'power2.out'
        })
        gsap.to(preloader, {
            y: '-100%',
            delay: 0.6,
            duration: 1.3,
            ease: "power2.inOut"
        })
    }
}

