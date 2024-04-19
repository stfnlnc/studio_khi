import React, {useState} from "react"
import {createRoot} from "react-dom/client";
import {unmountComponentAtNode} from "react-dom";

function Filter(props) {
    const [active, setActive] = useState(false)

    const handleClick = () => {
        setActive(!active)
    }

    return <span onClick={handleClick} className={'filter' + (active ? ' filter--active' : '')}>
        {props.content}
    </span>
}


class FilterElement extends HTMLElement {

    connectedCallback() {
        const props = this.dataset
        const root = createRoot(this)
        root.render(<Filter {...props}/>)
    }

    disconnectedCallback() {
        unmountComponentAtNode(this)
    }

}

customElements.define('filter-react', FilterElement)