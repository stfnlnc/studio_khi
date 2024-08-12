import {gsap} from "gsap";

export function faq() {
    const faqsTitle = document.querySelectorAll('.faq__title')
    const faqsAnswer = document.querySelectorAll('.faq__answer')
    const faqsIcon = document.querySelectorAll('.faq__icon')
    if(faqsTitle) {
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
    }
}

