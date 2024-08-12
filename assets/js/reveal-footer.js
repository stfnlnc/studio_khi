import {gsap} from "gsap";

export function revealFooter() {
    const footer = document.querySelector('#footer')
    if(footer) {
        gsap.from(footer,
            {
                yPercent: -100,
                duration: 1,
                scrollTrigger: {
                    trigger: footer,
                    start: 'top 80%',
                    end: '',
                    markers: false,
                    scrub: true,
                },
            }
        );
    }
}

