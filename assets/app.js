import './styles/app.css';
import {gsap} from "gsap";
import {preloader} from "./js/preloader";
import {topContent} from "./js/top-content";
import {topImage} from "./js/top-image";
import {fixedTitle} from "./js/fixed-title";
import {pinSection} from "./js/pin-section";
import {revealTop} from "./js/reveal-top";
import {link} from "./js/link";
import {revealImage} from "./js/reveal-image";
import {revealTitle} from "./js/reveal-title";
import {revealFooter} from "./js/reveal-footer";
import {delayTitle} from "./js/delay-title";
import {smoothScroll} from "./js/smooth-scroll";
import {disableAlert} from "./js/disable-alert";
import {dropdown} from "./js/dropdown";
import {dropdownMobile} from "./js/dropdown-mobile";
import {hideNav} from "./js/hide-nav";
import {filter} from "./js/filter";
import {faq} from "./js/faq";
import {cookie} from "./js/cookie";

import {ScrollTrigger} from "gsap/ScrollTrigger";

/* The following plugins are Club GSAP perks */
import {ScrollSmoother} from "gsap/ScrollSmoother";
import {SplitText} from "gsap/SplitText";

gsap.registerPlugin(ScrollTrigger, ScrollSmoother, SplitText);

document.addEventListener("DOMContentLoaded", function (event) {
    window.onload = function () {

        hideNav()
        preloader()
        disableAlert()
        dropdownMobile()
        filter()
        faq()
        cookie()

        let mm = gsap.matchMedia();

// add a media query. When it matches, the associated function will run
        mm.add("(min-width: 834px)", () => {
            topContent()
            topImage()
            revealFooter()
            pinSection()
            smoothScroll()
            revealTop()
            revealImage()
            fixedTitle()
            link()
            dropdown()
            revealTitle()
            delayTitle()
        })

    }
})
