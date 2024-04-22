import React from "react"
import {createRoot} from "react-dom/client";
import {unmountComponentAtNode} from "react-dom";
import MenuIcon from './MenuIcon'
import Button from './Button'
import MenuItemMobile from "./MenuItemMobile";

function DropdownMobile(props) {

    return <div id="dropdown-mobile" className="dropdown-mobile flex col align--start justify--start">
        <div className="header__gap mb--4"></div>
        <div className="flex col w--100 border--top border-stroke-dark">
            <MenuItemMobile dropmenu='{"Branding & Direction Artistique": "#", "Webdesign & Design Digital": "#", "Développement Web & Sites Sur Mesure": "#"}'>Services</MenuItemMobile>
            <MenuItemMobile href="#">Réalisations</MenuItemMobile>
            <MenuItemMobile href="#">FAQ</MenuItemMobile>
            <MenuItemMobile href="#">Studio</MenuItemMobile>
            <MenuItemMobile href="#">Articles</MenuItemMobile>
            <span className="container pt--8 pb--0">
                <Button href="#" color="light">Contact</Button>
            </span>
        </div>
    </div>

}


class DropdownMobileElement extends HTMLElement {

    connectedCallback() {
        const props = this.dataset
        const root = createRoot(this)
        root.render(<DropdownMobile {...props}/>)
    }

    disconnectedCallback() {
        unmountComponentAtNode(this)
    }

}

customElements.define('dropdown-mobile-react', DropdownMobileElement)