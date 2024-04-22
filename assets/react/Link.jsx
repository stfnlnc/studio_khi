import React from "react"
import {createRoot} from "react-dom/client";
import {unmountComponentAtNode} from "react-dom";

export default function Link(props) {
    let color, icon

    if(props.color) {
        color = ' link__' + props.color + ' '
        icon = ' link__' + props.color + '__icon '
    } else {
        color = ''
        icon = ''
    }

    if(props.icon) {
        return <a href={props.href} className={'link ' + color + props.className}>
            {props.content}{props.children}
            <svg className={'link__icon' + icon} viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
                <path d="M4.5 13.5L13.5 4.5" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round"/>
                <path d="M6.1875 4.5H13.5V11.8125" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round"/>
            </svg>
        </a>
    } else if (props.border) {
        return <a href={props.href} className={'link ' + color + props.className}>
            {props.content}{props.children}
        </a>
    } else {
        return <a href={props.href} className={'link ' + color + ' link__no-underline ' + props.className}>
            {props.content}{props.children}
        </a>
    }

}


class LinkElement extends HTMLElement {

    connectedCallback() {
        const props = this.dataset
        const root = createRoot(this)
        root.render(<Link {...props}/>)
    }

    disconnectedCallback() {
        unmountComponentAtNode(this)
    }

}

customElements.define('link-react', LinkElement)