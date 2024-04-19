import React from "react"
import {createRoot} from "react-dom/client";
import {unmountComponentAtNode} from "react-dom";
import Link from './Link'

function Dropdown(props) {

    const handleLeave = () => {
            document.querySelectorAll('.menu__item').forEach((item) => {
                item.classList.remove('menu__item__light')
            })
            document.querySelector('header').style.borderColor = 'var(--stroke-light)'
            document.querySelector('.header__logo').style.fill = 'var(--primary-dark)'
            document.querySelector('.dropdown').style.top = '-100%'
    }

    return <div id="dropdown" className="dropdown flex col align--center justify--center">
        <div className="p--15"></div>
        <div onMouseLeave={handleLeave} className="dropdown__menu primary-light grid grid--3 gap--11">
            <div className="flex col gap--5">
                <div className="flex col">
                    <p className="text__m">01</p>
                    <Link href="#" content="" color="light" icon="1">Branding & <br/> Direction Artistique</Link>
                </div>
                <div>
                    <p className="text__s primary-grey">
                        Moodboards <br/>
                        Logo <br/>
                        Identité visuelle <br/>
                        Charte graphique <br/>
                        Design Réseaux Sociaux <br/>
                        Pitchdeck
                    </p>
                </div>
            </div>
            <div className="flex col gap--5">
                <div className="flex col">
                    <p className="text__m">02</p>
                    <Link href="#" content="" color="light" icon="1">Webdesign & <br/> Design Digital</Link>
                </div>
                <div>
                    <p className="text__s primary-grey">
                        Webdesign <br/>
                        UX & UI Design <br/>
                        Wireframe <br/>
                        Maquettes & Prototypes <br/>
                        Design System
                    </p>
                </div>
            </div>
            <div className="flex col gap--5">
                <div className="flex col">
                    <p className="text__m">03</p>
                    <Link href="#" content="" color="light" icon="1">Développement Web & <br/> Sites Sur Mesure</Link>
                </div>
                <div>
                    <p className="text__s primary-grey">
                        Site Vitrine <br/>
                        Site E-Commerce <br/>
                        Front-End & Back-End <br/>
                        Fonctionnalités Sur Mesure <br/>
                        SEO & Référencement Naturel <br/>
                        Formation & Maintenance
                    </p>
                </div>
            </div>
        </div>
    </div>

}


class DropdownElement extends HTMLElement {

    connectedCallback() {
        const props = this.dataset
        const root = createRoot(this)
        root.render(<Dropdown {...props}/>)
    }

    disconnectedCallback() {
        unmountComponentAtNode(this)
    }

}

customElements.define('dropdown-react', DropdownElement)