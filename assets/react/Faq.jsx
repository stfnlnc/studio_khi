import React, {useState} from "react"
import {createRoot} from "react-dom/client";
import {unmountComponentAtNode} from "react-dom";
import MenuIcon from "./MenuIcon";

function Faq(props) {

    const [rotate, setRotate] = useState('45deg')

    const handleClick = () => {
        if (rotate === '45deg') {
            setRotate('0')
            if(props.color) {
                document.getElementById(props.id).style.fill = 'var(--primary-light)'
            } else {
                document.getElementById(props.id).style.fill = 'var(--primary-dark)'
            }
            document.querySelector('.faq__answer-' + props.id).style.maxHeight = '500px'
        } else {
            setRotate('45deg')
            document.getElementById(props.id).style.fill = 'var(--primary-grey)'
            document.querySelector('.faq__answer-' + props.id).style.maxHeight = '0'
        }
        document.getElementById(props.id).style.transform = 'rotate(' + rotate + ')'
    }

    return <div className={'flex col pt--4 pb--4 border--bottom ' + (props.color ? ' border-stroke-dark' : ' border-stroke-light')}>
        <div onClick={handleClick} className="flex row align--center justify--space-between pointer">
            <p className="text__l">
                {props.title}
            </p>
            <svg className="faq__icon plus__icon" id={props.id} xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 14 14">
                <path
                    d="M13.7087 6.83423L13.7087 7.3084C13.7087 7.57019 13.4964 7.78246 13.2346 7.78251L7.78224 7.78246L7.78219 13.2348C7.78224 13.4966 7.56997 13.7089 7.3081 13.7089L6.83398 13.7089C6.57216 13.7089 6.3599 13.4966 6.35987 13.2348L6.35991 7.78246L0.907542 7.78245C0.64572 7.78247 0.433446 7.5702 0.433446 7.30835L0.433445 6.83424C0.433445 6.57239 0.645725 6.36011 0.907547 6.36014L6.35991 6.36012L6.35987 0.907804C6.3599 0.645932 6.57216 0.433669 6.83398 0.433694L7.30814 0.433643C7.56996 0.433668 7.78224 0.645947 7.78224 0.907744V6.36012L13.2346 6.36007C13.4964 6.36012 13.7087 6.57239 13.7087 6.83423Z"/>
            </svg>
        </div>
        <div className={'faq__answer faq__answer-' + props.id}>
            <p className="primary-grey pt--2">
                {props.content}
            </p>
        </div>
    </div>

}


class FaqElement extends HTMLElement {

    connectedCallback() {
        const props = this.dataset
        const root = createRoot(this)
        root.render(<Faq {...props}/>)
    }

    disconnectedCallback() {
        unmountComponentAtNode(this)
    }

}

customElements.define('faq-react', FaqElement)