export function cookie() {
    const cookies = document.getElementById('cookies')
    const cookieAgree = document.querySelector('.agree')
    if (cookies) {
        cookieAgree.addEventListener('click', () => {
            document.cookie = 'cookies=agree';
            cookies.style.display = 'none'
        })


        if (document.cookie.includes('cookies=agree')) {
            cookies.style.display = 'none'
        }
    }
}

