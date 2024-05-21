import React from "react"
import {createRoot} from "react-dom/client";
import {unmountComponentAtNode} from "react-dom";

export default function Link(props) {

    let color = props.color ? (' link__' + props.color + ' ') : ''
    let icon = props.color ? (' link__' + props.color + '__icon ') : ''

    let svg = <svg className={'link__icon' + icon} viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg"><path d="M4.5 13.5L13.5 4.5" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round"/><path d="M6.1875 4.5H13.5V11.8125" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round"/></svg>

    let border = props.border || props.icon ? '' : ' link__no-underline ';

    return <a id={props.id} target={props.target} href={props.href} className={'link ' + color + border + props.className}>
        {props.content}{props.children}
        {props.icon ? svg : ''}
    </a>

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