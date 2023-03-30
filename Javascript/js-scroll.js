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

document.addEventListener('scroll', function () {
    const scrollPosition = document.documentElement.scrollTop || document.body.scrollTop;
    menu_links.forEach(link => {
        const href = link.getAttribute('href');
        const element = document.querySelector(href);
        if (scrollPosition >= element.offsetTop - 100 && scrollPosition < element.offsetTop + element.offsetHeight - 100) {
            clearActive();
            if (!link.classList.contains('active')) {
                link.classList.add('active');
            }
        }
    });
}, {
    passive: true
});
function clearActive() {
    menu_links.forEach(link => {
        link.classList.remove('active');
    });
}

