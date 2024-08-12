import {gsap} from "gsap";

export function topImage() {
    const topImage = document.querySelector('#top-image')
    const triggerImage = document.querySelector('#trigger-image')

    if (topImage && triggerImage) {
        gsap.to(triggerImage,
            {
                scale: 0.8,
                duration: 1,
                ease: "power2.inOut",
                scrollTrigger: {
                    pin: true,
                    pinSpacing: true,
                    trigger: topImage,
                    start: "top top",
                    scrub: 1,
                    markers: false,
                    invalidateOnRefresh: true,
                }
            },
        )
    }
}

