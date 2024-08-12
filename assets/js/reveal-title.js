import {gsap} from "gsap";
import {SplitText} from "gsap/SplitText";

export function revealTitle() {
    const titles = document.querySelectorAll(".title");
    if (titles) {
        titles.forEach((title) => {
            const splitTitle = new SplitText(title, {type: "words"});
            const chars = splitTitle.words;

            gsap.from(chars, {
                scrollTrigger: {
                    trigger: title,
                    start: 'top 80%',
                    end: '',
                    markers: false
                },
                y: '100%',
                opacity: 0,
                duration: 0.5,
                ease: 'power2.out',
                stagger: 0.05,
            });
        })
    }
}

