import React from "react"
import {createRoot} from "react-dom/client";
import {unmountComponentAtNode} from "react-dom";
import MenuIcon from './MenuIcon'
import Button from './Button'
import MenuItemMobile from "./MenuItemMobile";

function DropdownMobile(props) {

    const href = JSON.parse(props.href)

    return <div id="dropdown-mobile" className="dropdown-mobile flex col align--start justify--start">
        <div className="header__gap mb--4"></div>
        <div className="flex col w--100 border--top border-stroke-dark">
            <MenuItemMobile dropmenu={
                '{"Branding & Direction Artistique": "' + href.branding + '",' +
                '"Webdesign & Design Digital": "' + href.webdesign + '",' +
                '"Développement Web & Sites Sur Mesure": "' + href.webdesign + '"}'
                }>Services</MenuItemMobile>
            <MenuItemMobile href={href.projects}>Réalisations</MenuItemMobile>
            <MenuItemMobile href={href.faq}>FAQ</MenuItemMobile>
            <MenuItemMobile href={href.studio}>Studio</MenuItemMobile>
            <MenuItemMobile href={href.posts}>Articles</MenuItemMobile>
            <span className="container pt--8 pb--0">
                <Button href={href.contact} color="light">Contact</Button>
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