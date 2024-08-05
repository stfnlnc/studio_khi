import './styles/app.css';
import {gsap} from "gsap";

import {ScrollTrigger} from "gsap/ScrollTrigger";

/* The following plugins are Club GSAP perks */
import {ScrollSmoother} from "gsap/ScrollSmoother";
import {SplitText} from "gsap/SplitText";

gsap.registerPlugin(ScrollTrigger, ScrollSmoother, SplitText);
document.addEventListener("DOMContentLoaded", function (event) {
    window.onload = function () {

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
                ease: "power2.inOut",
                scrollTrigger: {
                    pin: true,
                    trigger: topContent,
                    start: "top top",
                    scrub: 1,
                    markers: false
                }
            })

// TOP IMAGE __ __ __ __ __ __ __ __
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

// FIXED CONTENT __ __ __ __ __ __ __ __
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

// IMAGE ANIMATION __ __ __ __ __ __ __ __
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

// TITLE DELAY ANIMATION __ __ __ __ __ __ __ __
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

// SMOOTH SCROLL __ __ __ __ __ __ __ __
            ScrollSmoother.create({
                smooth: 2,
                effects: true
            });
// DELETE ALERT ON CLICK __ __ __ __ __ __ __ __
        const alerts = document.querySelectorAll('.alert')
        alerts.forEach(alert => {
            alert.addEventListener('click', () => {
                alert.style.display = 'none'
            })
        })

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

        const footer = document.querySelector('#footer')

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
        const projects = document.querySelectorAll('article')

        filters.forEach(filter => {
            filter.addEventListener('click', () => {
                filters.forEach(filter => {
                    filter.classList.remove('filter--active')
                })
                filter.classList.add('filter--active')
                const shows = document.querySelectorAll('.' + filter.id)
                projects.forEach(project => {
                    gsap.to(project, {
                        duration: 0.5,
                        ease: "power2.inOut",
                        opacity: 0,
                        display: 'none'
                    })
                })
                shows.forEach(show => {
                    gsap.to(show, {
                        duration: 0.5,
                        ease: "power2.inOut",
                        opacity: 1,
                        display: 'flex'
                    })
                })
                if (filter.id === 'all') {
                    projects.forEach(project => {
                        gsap.to(project, {
                            duration: 0.5,
                            ease: "power2.inOut",
                            opacity: 1,
                            display: 'flex'
                        })
                    })
                }
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

// COOKIES DISPLAY __ __ __ __ __ __ __ __
        const cookies = document.getElementById('cookies')
        if (cookies) {
            if (document.cookie.includes('cookies=agree')) {
                cookies.style.display = 'none'
            }
        }

    }
})
