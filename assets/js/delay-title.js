import {gsap} from "gsap";
import {SplitText} from "gsap/SplitText";

export function delayTitle() {
    const titlesDelay = document.querySelectorAll(".title-delay");
    if (titlesDelay) {
        titlesDelay.forEach((title) => {
            const splitTitle = new SplitText(title, {type: "lines, words, chars", linesClass: "lines w--100"});
            new SplitText(title, {type: "lines", linesClass: "overflow-hidden w--100"});

            const chars = splitTitle.lines;

            gsap.from(chars, {
                y: '120%',
                duration: 0.5,
                delay: 1.4,
                ease: 'power2.out',
                stagger: 0.1,
            });
        })
    }
}

