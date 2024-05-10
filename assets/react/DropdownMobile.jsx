import React from "react"
import {createRoot} from "react-dom/client";
import {unmountComponentAtNode} from "react-dom";
import MenuIcon from './MenuIcon'
import Button from './Button'
import MenuItemMobile from "./MenuItemMobile";

function DropdownMobile(props) {

    const href = JSON.parse(props.href)

    let data
    data = Object.keys(href).map((key) =>
        [key, href[key]]
    )




    return <div id="dropdown-mobile" className="dropdown-mobile flex col align--start justify--start">
        <div className="header__gap mb--4"></div>
        <div className="flex col w--100 border--top border-stroke-dark">
            {
                data.map((href, key) => {

                    let drops
                    let dropmenu

                    if(href[1].drop) {
                        drops = Object.keys(href[1].drop).map((key) =>
                            [key, href[1].drop[key]]
                        )
                        drops.map((drop, key) => {
                            if(key === 0) {
                                dropmenu = '{"' + drop[1].name + '": "' + drop[1].path + '",'
                            } else if(key === drops.length - 1) {
                                dropmenu += '"' + drop[1].name + '": "' + drop[1].path + '"}'
                            } else {
                                dropmenu += '"' + drop[1].name + '": "' + drop[1].path + '",'
                            }
                        })
                    } else {
                        dropmenu = '';
                    }
                    return <MenuItemMobile key={key} href={href[1].path} dropmenu={dropmenu}>
                        {href[1].name}
                    </MenuItemMobile>
                })
            }
            <span className="container pt--8 pb--0">
                <Button href={props.contact} color="light">Contact</Button>
            </span>
        </div>
    </div>

}


class DropdownMobileElement extends HTMLElement {

    connectedCallback() {
        const props = this.dataset
        const root = createRoot(this)
        root.render(<DropdownMobile {...props}/>)
    }

    disconnectedCallback() {
        unmountComponentAtNode(this)
    }

}

customElements.define('dropdown-mobile-react', DropdownMobileElement)