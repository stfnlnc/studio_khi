export function cookie() {
    const cookies = document.getElementById('cookies')
    if (cookies) {
        if (document.cookie.includes('cookies=agree')) {
            cookies.style.display = 'none'
        }
    }
}

