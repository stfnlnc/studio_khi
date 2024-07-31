import './styles/app.css';
import 'htmx.org';
import {gsap} from "gsap-trial";

/* The following plugins are Club GSAP perks */
import {ScrollSmoother} from "gsap-trial/ScrollSmoother";
import {SplitText} from "gsap-trial/SplitText";
import {ScrollTrigger} from "gsap-trial/ScrollTrigger";


gsap.registerPlugin(ScrollSmoother, SplitText, ScrollTrigger);

window.htmx = require('htmx.org');

htmx.onLoad(function () {

    // PRELOADER __ __ __ __ __ __ __ __

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

    // TOP CONTENT __ __ __ __ __ __ __ __

    const topContent = document.querySelector('#top-content')

    gsap.to(topContent, {
        filter: 'blur(5px)',
        duration: 1,
        scrollTrigger: {
            pin: true,
            trigger: topContent,
            start: "top top",
            scrub: 1,
            markers: false
        }
    })

    // SERVICE SECTIONS __ __ __ __ __ __ __ __

    const branding = document.querySelector('#service-1')
    const digital = document.querySelector('#service-2')
    const dev = document.querySelector('#service-3')

    const tl = gsap.timeline()

    tl.to(branding, {
        filter: 'blur(5px)',
        duration: 1,
        scrollTrigger: {
            pin: true,
            trigger: branding,
            start: "0% top",
            scrub: 1,
            markers: false
        }
    }).to(digital, {
        duration: 2,
        scrollTrigger: {
            trigger: branding,
            start: "bottom bottom",
            end: 'top top',
            scrub: 1,
            markers: false
        }
    }).to(digital, {
        filter: 'blur(5px)',
        duration: 1,
        scrollTrigger: {
            pin: true,
            trigger: digital,
            start: "top top",
            end: '100% top',
            scrub: 1,
            markers: false
        }
    }).to(dev, {
        duration: 2,
        scrollTrigger: {
            trigger: digital,
            start: "bottom bottom",
            end: 'top top',
            scrub: 1,
            markers: false
        }
    }).to(dev, {
        filter: 'blur(5px)',
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

    // LOGO REVEAL __ __ __ __ __ __ __ __

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

    // LINK ICON AND LINE __ __ __ __ __ __ __ __

    const links = document.querySelectorAll('.link')
    const lines = document.querySelectorAll('.line')
    const icons = document.querySelectorAll('.link__icon')

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
    icons.forEach(icon => {
        gsap.from(icon, {
            opacity: 0,
            duration: 0.8,
            x: -10,
            y: 10,
            delay: 1.5,
            ease: "power1.in",
            scrollTrigger: {
                trigger: icon,
                start: "top 95%",
                toggleActions: "play none none none",
                markers: false
            }
        });
    });
    links.forEach(link => {
        link.addEventListener('mouseover', () => {
            const icon = link.querySelector('.link__icon')
            gsap.to(icon, {
                duration: 0.1,
                transform: 'translate(0.3rem, -0.3rem)',
                ease: "power1.in",
            });
        })
        link.addEventListener('mouseout', () => {
            const icon = link.querySelector('.link__icon')
            gsap.to(icon, {
                duration: 0.1,
                transform: 'translate(0, 0)',
                ease: "power1.in",
            });
        })
    });

    // TITLE ANIMATION __ __ __ __ __ __ __ __

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

    // HEADING ANIMATION __ __ __ __ __ __ __ __

    const headings = document.querySelectorAll(".heading");
    if (headings) {
        headings.forEach((heading) => {
            const splitHeading = new SplitText(heading, {type: "words"});
            const chars = splitHeading.words;

            gsap.from(chars, {
                scrollTrigger: {
                    trigger: heading,
                    start: 'top 90%',
                    end: '',
                    markers: false
                },
                x: '50%',
                opacity: 0,
                duration: 0.5,
                ease: 'power2.out',
                stagger: 0.1,
            });
        })
    }

    // STUDIO IMAGE __ __ __ __ __ __ __ __

    const studioImg = document.querySelectorAll('.studio__img-about')

    studioImg.forEach(image => {
        gsap.from(image, {
            scrollTrigger: {
                trigger: image,
                start: 'top 100%',
                end: 'bottom 60%',
                markers: true,
                scrub: 1
            },
            filter: 'blur(8px)'
        })
    })

    // FAQ __ __ __ __ __ __ __ __

    const faqsTitle = document.querySelectorAll('.faq__title')
    const faqsAnswer = document.querySelectorAll('.faq__answer')
    const faqsIcon = document.querySelectorAll('.faq__icon')

    faqsTitle.forEach((title, key) => {
        title.addEventListener('click', () => {
            let maxHeight
            let rotate
            if (faqsAnswer[key].style.maxHeight === '400px') {
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

    // SMOOTH SCROLL __ __ __ __ __ __ __ __

    ScrollSmoother.create({
        smooth: 2,
        effects: true
    });


    // RESIZE HEADER __ __ __ __ __ __ __ __

    const header = document.querySelector('header')
    const headerNav = document.querySelector('.header__nav')

    function resizeHeader() {
        if (window.scrollY > 20) {
            headerNav.style.padding = '20px var(--main-padding-h)'
            header.style.borderColor = 'transparent'
            header.style.backdropFilter = 'blur(10px)'
        } else {
            header.style.backdropFilter = 'blur(0)'
            headerNav.style.padding = 'var(--nav-padding-v) var(--main-padding-h)'
            header.style.borderColor = 'var(--stroke-light)'
        }
    }

    resizeHeader()

    // HEADER REMOVE AT BOTTOM __ __ __ __ __ __ __ __

    const main = document.querySelector('main')
    document.addEventListener('scroll', () => {
        resizeHeader()
        if ((window.scrollY + (window.innerHeight / 3)) > main.scrollHeight) {
            header.style.transform = 'translate(-50%, -100%)'
        } else {
            header.style.transform = 'translate(-50%, 0)'
        }
    })

    // DELETE ALERT ON CLICK __ __ __ __ __ __ __ __

    const alerts = document.querySelectorAll('.alert')
    alerts.forEach(alert => {
        alert.addEventListener('click', () => {
            alert.style.display = 'none'
        })
    })

    // COOKIES DISPLAY __ __ __ __ __ __ __ __

    const cookies = document.getElementById('cookies')
    if (cookies) {
        if (document.cookie.includes('cookies=agree')) {
            cookies.style.display = 'none'
        }
    }

    // DROPDOWN DESKTOP __ __ __ __ __ __ __ __

    const dropdownMenu = document.querySelector('#dropdown')

    dropdownMenu.addEventListener('mouseover', () => {
        document.querySelector('main').style.filter = 'blur(10px)'
        document.querySelector('footer').style.filter = 'blur(10px)'
        document.querySelector('.header__logo').style.fill = 'var(--primary-light)'
        document.querySelector('.dropdown').style.transform = 'translate(-50%, 0)'
        document.querySelectorAll('.menu__item').forEach((item) => {
            item.classList.add('menu__item__light')
        })
    })
    dropdownMenu.addEventListener('mouseout', () => {
        document.querySelector('main').style.filter = 'blur(0)'
        document.querySelector('footer').style.filter = 'blur(0)'
        document.querySelector('.header__logo').style.fill = 'var(--primary-dark)'
        document.querySelector('.dropdown').style.transform = 'translate(-50%, -100%)'
        document.querySelectorAll('.menu__item').forEach((item) => {
            item.classList.remove('menu__item__light')
        })
    })

    // DROPDOWN MOBILE __ __ __ __ __ __ __ __

    const menuMobile = document.querySelector('.menu__mobile')
    const menuClose = document.querySelector('.menu__mobile__close')
    const menuMobileDropdown = document.querySelector('.dropdown-mobile')

    menuMobile.addEventListener('click', () => {
        gsap.to(menuMobileDropdown, {
            right: 0,
            duration: 0.8,
            ease: "power2.inOut"
        })
        document.querySelector('main').style.filter = 'blur(10px)'
        document.querySelector('footer').style.filter = 'blur(10px)'
    })
    menuClose.addEventListener('click', () => {
        gsap.to(menuMobileDropdown, {
            right: '-100%',
            duration: 0.8,
            ease: "power2.inOut"
        })
        document.querySelector('main').style.filter = 'blur(0)'
        document.querySelector('footer').style.filter = 'blur(0)'
    })

    // FILTERS __ __ __ __ __ __ __ __

    const filters = document.querySelectorAll('.filter')

    filters.forEach(filter => {

        const projects = document.querySelectorAll('.article')

        filter.addEventListener('click', () => {
            filters.forEach(filter => {
                filter.classList.remove('filter--active')
            })
            filter.classList.add('filter--active')
            const shows = document.querySelectorAll('.' + filter.id)
            if (filter.id === "all") {
                projects.forEach(project => {
                    project.style.display = 'flex'
                })
            } else {
                projects.forEach(project => {
                    project.style.display = 'none'
                })
                shows.forEach(show => {
                    show.style.display = 'flex'
                })
            }
        })
    })
})