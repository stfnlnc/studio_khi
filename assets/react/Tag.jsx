import React from "react"
import {createRoot} from "react-dom/client";
import {unmountComponentAtNode} from "react-dom";

function Tag(props) {
    let color

    if(props.color) {
        color = ' tag__' + props.color
    } else {
        color = ''
    }

    return <span className={'tag text__m' + color}>
        {props.content}
    </span>

}


class TagElement extends HTMLElement {

    connectedCallback() {
        const props = this.dataset
        const root = createRoot(this)
        root.render(<Tag {...props}/>)
    }

    disconnectedCallback() {
        unmountComponentAtNode(this)
    }

}

customElements.define('tag-react', TagElement)