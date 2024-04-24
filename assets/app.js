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

// Resize header when scrolling
document.addEventListener('scroll', () => {
    if(window.scrollY > 100 ) {
        document.querySelector('.header__nav').style.padding = '10px var(--main-padding-h)'
        document.querySelector('header').style.borderColor = 'transparent'
    } else {
        document.querySelector('.header__nav').style.padding = 'var(--nav-padding-v) var(--main-padding-h)'
        document.querySelector('header').style.borderColor = 'var(--stroke-light)'
    }
})

// Remove header when footer appears
document.addEventListener('scroll', () => {
    if((window.scrollY + (window.innerHeight / 3)) > (document.querySelector('main').scrollHeight)) {
        document.querySelector('header').style.transform = 'translate(-50%, -100%)'
    } else {
        document.querySelector('header').style.transform = 'translate(-50%, 0)'
    }
})

