export function dropdown() {
    const dropdownMenu = document.querySelector('#dropdown')
    const dropdown = document.querySelector('.dropdown')
    function mouserOver() {
        document.querySelector('main').style.filter = 'blur(10px)'
        if(document.querySelector('footer')) {
            document.querySelector('footer').style.filter = 'blur(10px)'
        }
        document.querySelector('.dropdown').style.transform = 'translate(-50%, 0)'
    }

    function mouserOut() {
        document.querySelector('main').style.filter = 'blur(0)'
        if(document.querySelector('footer')) {
            document.querySelector('footer').style.filter = 'blur(0)'
        }
        document.querySelector('.dropdown').style.transform = 'translate(-50%, -100%)'
    }

    if(dropdownMenu) {
        dropdownMenu.addEventListener('mouseover', () => {
            mouserOver()
        })
        dropdown.addEventListener('mouseover', () => {
            mouserOver()
        })
        dropdownMenu.addEventListener('mouseout', () => {
            mouserOut()
        })
        dropdown.addEventListener('mouseout', () => {
            mouserOut()
        })
    }
}

