import {gsap} from "gsap";

export function pinSection() {
    const branding = document.querySelector('#service-1')
    const digital = document.querySelector('#service-2')
    const dev = document.querySelector('#service-3')

    const tl = gsap.timeline()
    if(branding && digital && dev) {
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
    }

}

