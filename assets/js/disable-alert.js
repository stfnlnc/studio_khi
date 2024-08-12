export function disableAlert() {
    const alerts = document.querySelectorAll('.alert')
    if(alerts) {
        alerts.forEach(alert => {
            alert.addEventListener('click', () => {
                alert.style.display = 'none'
            })
        })
    }
}

