import {gsap} from "gsap";

export function topContent() {
    const topContent = document.querySelector('#top-content')
    if(topContent) {
        gsap.to(topContent, {
            filter: 'blur(5px)',
            duration: 1,
            ease: "power2.inOut",
            scrollTrigger: {
                pin: true,
                trigger: topContent,
                start: "top top",
                scrub: 1,
                markers: false
            }
        })
    }
}

