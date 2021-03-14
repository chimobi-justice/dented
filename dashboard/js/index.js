let bodyClick = document.getElementsByTagName('body');
let navigationBar = document.getElementById('navbar');
let menu = document.getElementById('menu-icon');
let closeMenu = document.getElementById('close-icon');
let asideNav = document.querySelector('.aside-nav');
let mainBody = document.querySelector('.main-body');
    footerText = document.querySelector('#footer');


let icon = document.querySelector('.icon2');

// mobile nav
let mobileNavigationBar = document.getElementById('navbar-mobile');
let mobileMenu = document.getElementById('menu-icon-mobile');
let mobileCloseMenu = document.getElementById('close-icon-mobile');
let mobileAsideNav = document.querySelector('.aside-nav-mobile');

bodyClick.onclick = () => {
    if (bodyClick) {
        mobileAsideNav.style.display = 'none';
        console.log('click body');
    }

}

menu.onclick = () => {
    if (menu) {
        navigationBar.setAttribute('class', 'displayToggleNavigation');
        navigationBar.style.marginLeft = '0px';
        navigationBar.style.width = '100%';
        menu.style.display = 'none';
        closeMenu.style.display = 'block';
        mainBody.style.marginLeft = '5%';
        footerText.style.marginLeft = '5%';
        asideNav.classList.toggle('displayToggle');
    }
}

closeMenu.onclick = () => {
    if (closeMenu) {
        navigationBar.setAttribute('class', 'displayToggleNavigationLeft');
        navigationBar.style.marginLeft = '20%';
        navigationBar.style.width = '80%';
        menu.style.display = 'block';
        closeMenu.style.display = 'none';
        mainBody.style.marginLeft = '20%';
        footerText.style.marginLeft = '20%';
        asideNav.classList.toggle('displayToggle');
    }
}

mobileMenu.onclick = () => {
    if (mobileMenu) {
        mobileAsideNav.style.display = 'block';
    }
}

mobileCloseMenu.onclick = () => {
    if (mobileCloseMenu) {
        mobileAsideNav.style.display = 'none';
    }
}
// responses
let res = document.querySelector('.response');

if (res) {
    setTimeout(() => {
        res.remove();
    }, 5000);
}