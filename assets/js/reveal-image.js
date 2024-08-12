import {gsap} from "gsap";

export function revealImage() {
    const images = document.querySelectorAll(".image");
    if (images) {
        images.forEach((image) => {
            gsap.from(image, {
                scrollTrigger: {
                    trigger: image,
                    start: 'top 80%',
                    end: '',
                    markers: false
                },
                scale: 0.9,
                opacity: 0,
                duration: 2,
                ease: 'power2.out'
            });
        })
    }
}

