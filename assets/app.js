import './styles/app.css';
import './react/Component.jsx'
import './react/Tag.jsx'
import './react/Filter.jsx'
import './react/Dropdown.jsx'
import './react/MenuItem.jsx'
import './react/Link.jsx'
import './react/Button.jsx'
document.addEventListener('scroll', () => {
    if((window.scrollY + (window.innerHeight / 3)) > (document.querySelector('main').scrollHeight)) {
        document.querySelector('header').style.transform = 'translate(-50%, -100%)'
    } else {
        document.querySelector('header').style.transform = 'translate(-50%, 0)'
    }
})

