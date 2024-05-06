import React, {useState} from "react"
import {createRoot} from "react-dom/client";
import {unmountComponentAtNode} from "react-dom";

const posts = document.querySelectorAll('article')
const filters = document.querySelectorAll('filter-react')
if(filters[0]) {
    if(filters[0].dataset.id !== 'all') {
        posts.forEach((post, key) => {
            key !== 0 ? post.style.display = 'none' : post.style.display = 'flex'
        })
    } else {
        posts.forEach((post) => {
            post.style.display = 'flex'
        })
    }
}

function Filter(props) {

    const [active, setActive] = useState(true)

    const handleClick = (e) => {
        document.querySelectorAll('.filter--active').forEach(filter => {
            filter.classList.remove('filter--active')
        })
        e.target.classList.add('filter--active')

        if(e.target.id === 'all') {
            document.querySelectorAll('article').forEach(post => {
                post.style.display = 'flex'
            })
        } else {
            document.querySelectorAll('article').forEach(post => {
                post.style.display = 'none'
            })
            document.querySelectorAll('.' + e.target.id).forEach(post => {
                post.style.display = 'flex'
            })
        }

    }

    return <span id={props.id} onClick={handleClick} className={'filter' + (props.id === 'all' || props.id === 'logo' ? ' filter--active' : '')}>
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