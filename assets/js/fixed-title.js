import {gsap} from "gsap";

export function fixedTitle() {
    const fixedTitle = document.querySelector('#title-fixed')

    if (fixedTitle) {
        gsap.to(fixedTitle,
            {
                scrollTrigger: {
                    pin: true,
                    pinSpacing: false,
                    trigger: fixedTitle,
                    start: "top 15%",
                    end: "bottom 30%",
                    scrub: 1,
                    markers: false,
                    invalidateOnRefresh: true,
                }
            },
        )
    }
}

