import React from "react"
import {createRoot} from "react-dom/client";
import {unmountComponentAtNode} from "react-dom";

function MenuItem(props) {
    let color, active

    const handleEnter = () => {
        if(props.id === 'dropdown') {
            document.querySelectorAll('.menu__item').forEach((item) => {
                if(item.id !== 'disableDropdown') {
                    item.classList.add('menu__item__light')
                }
            })
            document.querySelector('header').style.borderColor = 'var(--stroke-dark)'
            document.querySelector('main').style.filter = 'blur(10px)'
            document.querySelector('footer').style.filter = 'blur(10px)'
            document.querySelector('.header__logo').style.fill = 'var(--primary-light)'
            document.querySelector('.dropdown').style.transform = 'translate(-50%, 0)'
        } else {
            document.querySelectorAll('.menu__item').forEach((item) => {
                if(item.id !== 'disableDropdown') {
                    item.classList.remove('menu__item__light')
                }
            })
            document.querySelector('header').style.borderColor = 'var(--stroke-light)'
            document.querySelector('.header__logo').style.fill = 'var(--primary-dark)'
            document.querySelector('.dropdown').style.transform = 'translate(-50%, -100%)'
            document.querySelector('main').style.filter = 'blur(0)'
            document.querySelector('footer').style.filter = 'blur(0)'
        }
    }

    if(props.color) {
        color = ' menu__item__' + props.color
        if(props.active) {
            active = ' menu__item__' + props.color + '--active'
        } else {
            active = ''
        }
    } else {
        color = ''
        if(props.active) {
            active = ' menu__item--active'
        } else {
            active = ''
        }
    }

        return <a onMouseEnter={handleEnter} href={props.href} id={props.id} className={'menu__item' + color + active}>
            {props.content}
        </a>

}


class MenuItemElement extends HTMLElement {

    connectedCallback() {
        const props = this.dataset
        const root = createRoot(this)
        root.render(<MenuItem {...props}/>)
    }

    disconnectedCallback() {
        unmountComponentAtNode(this)
    }

}

customElements.define('menu-item-react', MenuItemElement)