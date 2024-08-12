import {gsap} from "gsap";

export function link() {
    const links = document.querySelectorAll('.link')
    const lines = document.querySelectorAll('.line')
    const icons = document.querySelectorAll('.link__icon')
    if(lines && icons && links) {
        lines.forEach(line => {
            gsap.from(line, {
                scaleX: 0,
                duration: 1,
                transformOrigin: "left center",
                ease: "power2.inOut",
                scrollTrigger: {
                    trigger: line,
                    start: "top 95%",
                    toggleActions: "play none none none",
                    markers: false
                }
            });
        });
        icons.forEach(icon => {
            gsap.from(icon, {
                opacity: 0,
                duration: 0.8,
                x: -10,
                y: 10,
                delay: 0.5,
                ease: "power1.in",
                scrollTrigger: {
                    trigger: icon,
                    start: "top 95%",
                    toggleActions: "play none none none",
                    markers: false
                }
            });
        });
        links.forEach(link => {
            link.addEventListener('mouseover', () => {
                const icon = link.querySelector('.link__icon')
                gsap.to(icon, {
                    duration: 0.1,
                    transform: 'translate(0.3rem, -0.3rem)',
                    ease: "power1.in",
                });
            })
            link.addEventListener('mouseout', () => {
                const icon = link.querySelector('.link__icon')
                gsap.to(icon, {
                    duration: 0.1,
                    transform: 'translate(0, 0)',
                    ease: "power1.in",
                });
            })
        });
    }
}

