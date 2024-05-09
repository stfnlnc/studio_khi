import './styles/app.css';
import './react/Component.jsx'
import './react/Cookies.jsx'
import './react/Faq.jsx'
import './react/Tag.jsx'
import './react/Filter.jsx'
import './react/Dropdown.jsx'
import './react/DropdownMobile.jsx'
import './react/MenuItem.jsx'
import './react/MenuIcon.jsx'
import './react/Link.jsx'
import './react/Button.jsx'


// Preloader
const preloaderIcon = document.querySelector('.preloader__icon')
preloaderIcon.classList.add('preloader__icon-active')
const preloaderText = document.querySelector('.preloader__text')
preloaderText.classList.add('preloader__text-active')
const preloader = document.querySelector('.preloader')
const body = document.querySelector('body')
setTimeout(() => {
    preloader.classList.add('preloader__remove')
    setTimeout(() => {
        body.style.overflow = 'auto'
    }, 600)
}, 1000)

// Resize header when scrolling
const header = document.querySelector('header')
const headerNav = document.querySelector('.header__nav')
function resizeHeader () {
    if(window.scrollY > 100 ) {
        headerNav.style.padding = '10px var(--main-padding-h)'
        header.style.borderColor = 'transparent'
        header.style.backdropFilter = 'blur(10px)'
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
    if((window.scrollY + (window.innerHeight / 3)) > main.scrollHeight) {
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



