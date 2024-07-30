import './styles/app.css';

import 'htmx.org';
import { gsap } from "gsap-trial";

/* The following plugins are Club GSAP perks */
import { ScrollSmoother } from "gsap-trial/ScrollSmoother";
import { MorphSVGPlugin } from "gsap-trial/MorphSVGPlugin";
import { SplitText } from "gsap-trial/SplitText";
import { ScrollTrigger } from "gsap-trial/ScrollTrigger";
import { Draggable } from "gsap-trial/Draggable";


gsap.registerPlugin(ScrollSmoother,MorphSVGPlugin,SplitText, ScrollTrigger, Draggable);

window.htmx = require('htmx.org');

htmx.onLoad(function () {

    const preloader = document.querySelector('.preloader')
    const preloaderIcon = document.querySelector('.preloader__icon')
    const preloaderText = document.querySelector('.preloader__text')

    gsap.to(preloaderIcon, {
        x: 0,
        y: 0,
        duration: 0.8,
        opacity: 1,
        ease: 'power2.out'
    })
    gsap.to(preloaderText, {
        y: 0,
        duration: 0.8,
        opacity: 1,
        ease: 'power2.out'
    })
    gsap.to(preloader, {
            y: '-100%',
            delay: 0.6,
            duration: 1.3,
            ease: "power2.inOut"
    })

    const topContent = document.querySelector('#top-content')

    gsap.to(topContent, {
        filter: 'blur(8px)',
        duration: 1,
        scrollTrigger: {
            pin: true,
            trigger: topContent,
            start: "top top",
            scrub: 1,
            markers: false
        }
    })

    const branding = document.querySelector('#branding')
    const webdesign = document.querySelector('#webdesign')
    const dev = document.querySelector('#dev')

    const tl = gsap.timeline()

    tl.to(branding, {
        filter: 'blur(8px)',
        duration: 1,
        scrollTrigger: {
            pin: true,
            trigger: branding,
            start: "0% top",
            scrub: 1,
            markers: false
        }
    }).to(webdesign, {
        duration: 2,
        scrollTrigger: {
            trigger: branding,
            start: "bottom bottom",
            end: 'top top',
            scrub: 1,
            markers: false
        }
    }).to(webdesign, {
        filter: 'blur(8px)',
        duration: 1,
        scrollTrigger: {
            pin: true,
            trigger: webdesign,
            start: "top top",
            end: '100% top',
            scrub: 1,
            markers: false
        }
    }).to(dev, {
        duration: 2,
        scrollTrigger: {
            trigger: webdesign,
            start: "bottom bottom",
            end: 'top top',
            scrub: 1,
            markers: false
        }
    }).to(dev, {
        filter: 'blur(8px)',
        duration: 1,
        scrollTrigger: {
            pin: true,
            trigger: dev,
            start: "top top",
            end: '100% top',
            scrub: 1,
            markers: false
        }
    })

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

    const lines = document.querySelectorAll('.line')

    lines.forEach(line => {
        gsap.from(line, {
            scaleX: 0,
            duration: 1,
            transformOrigin: "left center",
            ease: "power2.inOut",
            scrollTrigger: {
                trigger: line,
                start: "top 95%",
                toggleActions: "play none none none",
                markers: false
            }
        });
    });

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
                stagger: 0.1,
            });
        })
    }

    const headings = document.querySelectorAll(".heading");
    if (headings) {
        headings.forEach((heading) => {
            const splitHeading = new SplitText(heading, {type: "words,chars"});
            const chars = splitHeading.chars;

            gsap.from(chars, {
                scrollTrigger: {
                    trigger: heading,
                    start: 'top 90%',
                    end: '',
                    markers: false
                },
                x: '50%',
                opacity: 0,
                duration: 0.08,
                ease: 'power2.out',
                stagger: 0.05,
            });
        })
    }

    const faqsTitle = document.querySelectorAll('.faq__title')
    const faqsAnswer = document.querySelectorAll('.faq__answer')
    const faqsIcon = document.querySelectorAll('.faq__icon')

    faqsTitle.forEach((title, key) => {
        title.addEventListener('click', () => {
            let maxHeight
            let rotate
            if(faqsAnswer[key].style.maxHeight === '400px') {
                maxHeight = 0
                rotate = 0
            } else {
                maxHeight = 400
                rotate = 45
            }
            gsap.to(faqsAnswer[key], {
                maxHeight: maxHeight,
                duration: 0.8,
                ease: 'power2.inOut'
            })
            gsap.to(faqsIcon[key], {
                rotation: rotate,
                duration: 0.1,
                ease: 'power2.inOut'
            })
        })
    })


    ScrollSmoother.create({
        smooth: 2,
        effects: true
    });


// Resize header when scrolling
    const header = document.querySelector('header')
    const headerNav = document.querySelector('.header__nav')

    function resizeHeader() {
        if (window.scrollY > 100) {
            headerNav.style.padding = '10px var(--main-padding-h)'
            header.style.borderColor = 'transparent'
            header.style.backdropFilter = 'blur(10px)'
            header.style.backgroundColor = 'rgba(224, 224, 224, 0.1)'
        } else {
            header.style.backdropFilter = 'blur(0)'
            headerNav.style.padding = 'var(--nav-padding-v) var(--main-padding-h)'
            header.style.borderColor = 'var(--stroke-light)'
        }
    }

    resizeHeader()

// Remove header when footer appears
    const main = document.querySelector('main')
    document.addEventListener('scroll', () => {
        resizeHeader()
        if ((window.scrollY + (window.innerHeight / 3)) > main.scrollHeight) {
            header.style.transform = 'translate(-50%, -100%)'
        } else {
            header.style.transform = 'translate(-50%, 0)'
        }
    })

// Delete alert on click
    const alerts = document.querySelectorAll('.alert')
    alerts.forEach(alert => {
        alert.addEventListener('click', () => {
            alert.style.display = 'none'
        })
    })

// Cookies alert display

    const cookies = document.getElementById('cookies')
    if (cookies) {
        if (document.cookie.includes('cookies=agree')) {
            cookies.style.display = 'none'
        }
    }

})