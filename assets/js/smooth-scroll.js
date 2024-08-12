import {ScrollSmoother} from "gsap/ScrollSmoother";

export function smoothScroll() {
    ScrollSmoother.create({
        smooth: 2,
        effects: true
    });
}

