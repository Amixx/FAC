import 'htmx.org';

window.setActiveLink = function(link) {
    const activeClasses= ['underline'];

    document.querySelectorAll('.nav-link').forEach(function (el) {
        el.classList.remove(...activeClasses);
    });
    if(typeof link === 'string') {
        const linkEl = document.querySelector(`[data-url="${link}"]`);
        linkEl.classList.add(...activeClasses);
    } else if(link) {
        link.classList.add(...activeClasses);
    }
}