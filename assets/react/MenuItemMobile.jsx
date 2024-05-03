import React, {useState} from "react"
import {createRoot} from "react-dom/client";
import {unmountComponentAtNode} from "react-dom";
import MenuIcon from "./MenuIcon";

export default function MenuItemMobile({dropmenu, href, ...props}) {

    const [rotate, setRotate] = useState('45deg')
    const handleClick = () => {
        if(dropmenu) {
            if (rotate === '45deg') {
                document.getElementById('dropdown-menu').style.maxHeight = '200px'
            } else {
                document.getElementById('dropdown-menu').style.maxHeight = '0'
            }
            if (rotate === '45deg') {
                setRotate('0')
            } else {
                setRotate('45deg')
            }
            document.querySelector('.menu__icon').style.transform = 'rotate(' + rotate + ')'
        }
    }

    let data
    let dataMenu

    if(dropmenu) {
        data = JSON.parse(dropmenu)
        dataMenu = Object.keys(data).map((key) =>
            [key, data[key]]
        )
    } else {
        data = false
        dataMenu = []
    }
    let i = 0
    let className

    return <div className="menu__item__mobile flex col">
        <a onClick={handleClick} href={href} className="flex row align--center justify--space-between">
            {props.children}
            {data ? <MenuIcon id="menu"></MenuIcon> : ''}
        </a>
        {dropmenu ?
        <div id="dropdown-menu" className="flex col gap--2 pl--4">
            {dataMenu.map((menu) => {
                i++
                if(i === 1) {
                    className = 'pt--4'
                } else if (i === dataMenu.length) {
                    className = 'pb--4'
                } else {
                    className = ''
                }
                return <a key={i} className={className} href={menu[1]}>{menu[0]}</a>
            })}
        </div> : '' }
    </div>

}


class MenuItemMobileElement extends HTMLElement {

    connectedCallback() {
        const props = this.dataset
        const root = createRoot(this)
        root.render(<MenuItemMobile {...props}/>)
    }

    disconnectedCallback() {
        unmountComponentAtNode(this)
    }

}

customElements.define('menu-item-mobile-react', MenuItemMobileElement)