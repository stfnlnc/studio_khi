import React, {useState} from "react"
import {createRoot} from "react-dom/client";
import {unmountComponentAtNode} from "react-dom";

function Filter(props) {
    const [active, setActive] = useState(false)

    const handleClick = (e) => {
        document.querySelectorAll('.filter').forEach((filter) => {
            filter.classList.remove('filter--active')
        })
        document.getElementById(e.target.id).classList.add('filter--active')
        if(e.target.id === 'all') {
            document.querySelectorAll('article').forEach((posts) => {
                posts.style.display = 'flex'
            })
        } else {
            document.querySelectorAll('article').forEach((posts) => {
                posts.style.display = 'none'
            })
            document.querySelectorAll('.' + e.target.id).forEach((post) => {
                post.style.display = 'flex'
            })
        }

    }

    return <span id={props.id} onClick={handleClick} className={'filter' + (active || props.id === 'all' ? ' filter--active' : '')}>
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