import {gsap} from "gsap";

export function filter() {
    const filters = document.querySelectorAll('.filter')
    const articles = document.querySelectorAll('article')
    if(filters) {
        filters.forEach(filter => {
            filter.addEventListener('click', () => {
                filters.forEach(filter => {
                    filter.classList.remove('filter--active')
                })
                filter.classList.add('filter--active')
                const shows = document.querySelectorAll('.' + filter.id)
                articles.forEach(project => {
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
                    articles.forEach(project => {
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
    }
}

