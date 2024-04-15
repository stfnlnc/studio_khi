import React from "react"
import {createRoot} from "react-dom/client";
import {unmountComponentAtNode} from "react-dom";


function Component() {
    return <div>Hello world</div>
}


class ComponentElement extends HTMLElement {

    connectedCallback() {
        const root = createRoot(this)
        root.render(<Component/>)
    }

    disconnectedCallback() {
        unmountComponentAtNode(this)
    }

}

customElements.define('component-react', ComponentElement)