const ppf = document.querySelector('.user__ppf') ?? null;
const userMenu = document.querySelector('.user-menu');

if (ppf !== null) {
  ppf.addEventListener('click', () => {
    userMenu.classList.toggle('user-menu--showing');
  });
}