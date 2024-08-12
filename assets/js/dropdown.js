export function dropdown() {
    const dropdownMenu = document.querySelector('#dropdown')
    const dropdown = document.querySelector('.dropdown')
    if(dropdownMenu) {
        dropdownMenu.addEventListener('mouseover', () => {
            document.querySelector('main').style.filter = 'blur(10px)'
            document.querySelector('footer').style.filter = 'blur(10px)'
            document.querySelector('.dropdown').style.transform = 'translate(-50%, 0)'
        })
        dropdown.addEventListener('mouseover', () => {
            document.querySelector('main').style.filter = 'blur(10px)'
            document.querySelector('footer').style.filter = 'blur(10px)'
            document.querySelector('.dropdown').style.transform = 'translate(-50%, 0)'
        })
        dropdownMenu.addEventListener('mouseout', () => {
            document.querySelector('main').style.filter = 'blur(0)'
            document.querySelector('footer').style.filter = 'blur(0)'
            document.querySelector('.dropdown').style.transform = 'translate(-50%, -100%)'
        })
        dropdown.addEventListener('mouseout', () => {
            document.querySelector('main').style.filter = 'blur(0)'
            document.querySelector('footer').style.filter = 'blur(0)'
            document.querySelector('.dropdown').style.transform = 'translate(-50%, -100%)'
        })
    }
}

