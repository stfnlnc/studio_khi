import {gsap} from "gsap";

export function dropdownMobile() {
    const menuMobile = document.querySelector('.menu__mobile')
    const menuClose = document.querySelector('.menu__mobile__close')
    const menuMobileDropdown = document.querySelector('.dropdown-mobile')
    if(menuMobile) {
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
    }
}

