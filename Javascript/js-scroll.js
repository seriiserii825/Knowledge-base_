export default function scrollToBlock() {
    const btn = document.querySelector('.section-header__link');
    const id = btn.getAttribute('href');
    const block = document.querySelector('#' + id);
    const box = block.getBoundingClientRect();

    btn.addEventListener('click', function (e) {
        e.preventDefault();
        block.scrollIntoView({behavior: 'smooth'});
    });
}
