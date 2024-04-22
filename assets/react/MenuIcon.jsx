import React, {useState} from "react"
import {createRoot} from "react-dom/client";
import {unmountComponentAtNode} from "react-dom";

export default function MenuIcon(props) {

    const [rotate, setRotate] = useState('45deg')

    const handleClick = () => {
        if(props.id === 'header') {
            if(rotate === '45deg') {
                document.getElementById('dropdown-mobile').classList.add('dropdown-mobile__display')
                document.querySelector('.header__logo').style.fill = 'var(--primary-light)'
                document.querySelector('.header__icon').style.fill = 'var(--primary-light)'
                document.querySelector('header').style.borderColor = 'var(--primary-dark)'
                document.querySelector('main').style.filter = 'blur(10px)'
                document.querySelector('footer').style.filter = 'blur(10px)'
            } else {
                document.getElementById('dropdown-mobile').classList.remove('dropdown-mobile__display')
                document.querySelector('.header__logo').style.fill = 'var(--primary-dark)'
                document.querySelector('.header__icon').style.fill = 'var(--primary-dark)'
                document.querySelector('header').style.borderColor = 'var(--stroke-light)'
                document.querySelector('main').style.filter = 'blur(0)'
                document.querySelector('footer').style.filter = 'blur(0)'
            }
        } else {
            if(rotate === '45deg') {
                document.getElementById('dropdown-menu').style.maxHeight = '1000px'
            } else {
                document.getElementById('dropdown-menu').style.maxHeight = '0'
            }
        }
        if(rotate === '45deg') {
            setRotate('0')
        } else {
            setRotate('45deg')
        }
        document.querySelector('.' + props.id +'__icon').style.transform = 'rotate(' + rotate + ')'
    }

    return <div>
        <svg onClick={handleClick} className={props.id + '__icon plus__icon'} xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14">
            <path
                d="M13.7087 6.83423L13.7087 7.3084C13.7087 7.57019 13.4964 7.78246 13.2346 7.78251L7.78224 7.78246L7.78219 13.2348C7.78224 13.4966 7.56997 13.7089 7.3081 13.7089L6.83398 13.7089C6.57216 13.7089 6.3599 13.4966 6.35987 13.2348L6.35991 7.78246L0.907542 7.78245C0.64572 7.78247 0.433446 7.5702 0.433446 7.30835L0.433445 6.83424C0.433445 6.57239 0.645725 6.36011 0.907547 6.36014L6.35991 6.36012L6.35987 0.907804C6.3599 0.645932 6.57216 0.433669 6.83398 0.433694L7.30814 0.433643C7.56996 0.433668 7.78224 0.645947 7.78224 0.907744V6.36012L13.2346 6.36007C13.4964 6.36012 13.7087 6.57239 13.7087 6.83423Z"/>
        </svg>
    </div>
}


class MenuIconElement extends HTMLElement {

    connectedCallback() {
        const props = this.dataset
        const root = createRoot(this)
        root.render(<MenuIcon {...props}/>)
    }

    disconnectedCallback() {
        unmountComponentAtNode(this)
    }

}

customElements.define('menu-icon-react', MenuIconElement)