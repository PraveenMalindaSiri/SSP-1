document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.getElementById('menu-toggle');
    const img = document.getElementById('menu-img');
    const nav = document.querySelector('.nav-links');

    toggle.addEventListener('click', function () {
        const isMenu = img.src.includes('menu.png');

        img.src = isMenu ? '/cb008920/public/assets/images/main/close.png' : '/cb008920/public/assets/images/main/menu.png';

        nav.classList.toggle('top-[9%]');
    })
});