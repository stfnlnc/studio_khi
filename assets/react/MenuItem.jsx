import React from "react"
import {createRoot} from "react-dom/client";
import {unmountComponentAtNode} from "react-dom";

function MenuItem(props) {
    let color, active

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

        return <a href={props.href} className={'menu__item' + color + active}>
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