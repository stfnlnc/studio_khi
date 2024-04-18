import React from "react"
import {createRoot} from "react-dom/client";
import {unmountComponentAtNode} from "react-dom";

function Button(props) {
    let color, icon

    if(props.color) {
        color = ' btn__' + props.color
        icon = ' btn__' + props.color + '__icon'
    } else {
        color = ''
        icon = ''
    }

    return <a href={props.href} className={'btn' + color}>
        {props.content}
        <svg className={'btn__icon' + icon} viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
            <path d="M4.5 13.5L13.5 4.5" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round"/>
            <path d="M6.1875 4.5H13.5V11.8125" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round"/>
        </svg>
    </a>
}


class ButtonElement extends HTMLElement {

    connectedCallback() {
        const props = this.dataset
        const root = createRoot(this)
        root.render(<Button {...props}/>)
    }

    disconnectedCallback() {
        unmountComponentAtNode(this)
    }

}

customElements.define('button-react', ButtonElement)