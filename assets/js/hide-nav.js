export function hideNav() {
    const header = document.querySelector('header')
    const footer = document.querySelector('footer')
    if(footer) {
        document.addEventListener('scroll', () => {
            if (footer.getBoundingClientRect().top < 0) {
                header.style.top = '-100%'
            } else {
                header.style.top = '0'
            }
        })
    }
}

