import {gsap} from "gsap";

export function revealTop() {
    const reveals = document.querySelectorAll(".reveal");
    if (reveals) {
        reveals.forEach((reveal) => {
            gsap.from(reveal, {
                y: 200,
                opacity: 0,
                duration: 1,
                delay: 1.2,
                ease: "power4"
            });
        })
    }
}

