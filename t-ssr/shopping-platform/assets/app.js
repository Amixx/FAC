import 'htmx.org';

window.setActiveLink = function(link) {
    const activeClasses = ['font-bold', 'underline', 'text-lime-200'];
    document.querySelectorAll('.nav-link').forEach(function (el) {
        el.classList.remove(...activeClasses);
    });
    link.classList.add(...activeClasses);
}