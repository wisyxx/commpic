const ppf = document.querySelector('.user-ppf');
const userMenu = document.querySelector('.user-menu');

ppf.addEventListener('click', () => {
    userMenu.classList.toggle('user-menu--showing');
})