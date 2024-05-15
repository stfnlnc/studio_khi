import React from "react"
import {createRoot} from "react-dom/client";
import {unmountComponentAtNode} from "react-dom";



function Cookies(props) {

    const cookies = document.getElementById('cookies')

    if(document.cookie.includes('cookies=agree')) {
        cookies.style.display ='none'
    }

    const handleClick = () => {
        cookies.style.opacity = '0'
        document.cookie = "cookies=agree; path=/; SameSite=strict; Secure";
        setTimeout(() => {
            cookies.style.display ='none'
        }, 500)
    }

    return <div className="primary-light--bg box-shadow p--5 flex row gap--4 align--center">
        <p className="text__s">Ce site utilise des cookies</p> <p onClick={handleClick} className="border--bottom link text__s">D'accord</p>
    </div>

}


class CookiesElement extends HTMLElement {

    connectedCallback() {
        const props = this.dataset
        const root = createRoot(this)
        root.render(<Cookies {...props}/>)
    }

    disconnectedCallback() {
        unmountComponentAtNode(this)
    }

}

customElements.define('cookies-react', CookiesElement)