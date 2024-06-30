const navbar = document.querySelector('.navbar-container')
const navSide = document.querySelector('.nav-side')

window.addEventListener('scroll', function () {
    if (window.scrollY > 150) {
        navbar.classList.add('is-scroll')
        navSide.style.top = '115%'
        navSide.style.borderRadius = '10px'
    } else {
        navbar.classList.remove('is-scroll')
        navSide.style.top = '100%'
        navSide.style.borderRadius = '0px'
    }
})

document.addEventListener('DOMContentLoaded', function () {
    const hamburger = document.querySelector('.hamburger');
    const checkbox = document.querySelector('input[type="checkbox"]');
    const navSide = document.getElementById('nav-side');
    const navLinks = document.querySelectorAll('.nav-link.side');
    const dropdownToggles = document.querySelectorAll('.nav-item.dropdown .nav-link.dropdown-toggle');

    // Toggle nav-side visibility when the checkbox changes
    checkbox.addEventListener('change', function () {
        if (checkbox.checked) {
            navSide.classList.add('checked');
        } else {
            navSide.classList.remove('checked');
        }
    });

    // Hide nav-side when clicking a link inside it
    navSide.addEventListener('click', function (event) {
        if (event.target.classList.contains('nav-link') || event.target.classList.contains('btn-login')) {
            checkbox.checked = false;
            navSide.classList.remove('checked');
        }
    });

    // Prevent hiding nav-side when clicking on dropdown toggle
    dropdownToggles.forEach(function (toggle) {
        toggle.addEventListener('click', function (event) {
            event.stopPropagation();
        });
    });

    // Hide nav-side when clicking outside of it
    document.addEventListener('click', function (event) {
        if (!navSide.contains(event.target) && !hamburger.contains(event.target) && checkbox.checked) {
            checkbox.checked = false;
            navSide.classList.remove('checked');
        }
    });

    // Hide nav-side when clicking on dropdown menu items
    document.querySelectorAll('.dropdown-menu .dropdown-item').forEach(function (item) {
        item.addEventListener('click', function () {
            checkbox.checked = false;
            navSide.classList.remove('checked');
        });
    });
});


// const navLinks = document.querySelectorAll('.nav-link')

// navLinks.forEach(function (nav) {
//     nav.addEventListener('click', function (e) {
//         navLinks.forEach(function (link) {
//             link.style.borderBottom = 'none';
//             link.style.paddingBottom = '0px';
//         });

//         e.target.style.borderBottom = '3px solid rgb(22, 51, 101)';
//         e.target.style.paddingBottom = '2px';
//     });
// });