document.addEventListener('DOMContentLoaded', function () {
    const email = document.querySelector('.email')
    const password = document.querySelector('.password')
    const alertEmail = document.querySelector('.alert')

    email.addEventListener('input', function () {
        if (!email.checkValidity()) {
            email.classList.add('invalid')
            alertEmail.classList.add('show')
        } else {
            email.classList.remove('invalid')
            alertEmail.classList.remove('show')
        }
    })
})