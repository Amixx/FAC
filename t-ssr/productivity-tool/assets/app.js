import 'htmx.org';

window.setActiveLink = function(link) {
    const activeClasses= ['text-white', 'bg-sky-700', 'rounded', 'md:bg-transparent', 'md:text-sky-700'];
    const inactiveClasses = ['text-gray-900', 'rounded', 'hover:bg-gray-100', 'md:hover:bg-transparent', 'md:border-0', 'md:hover:text-sky-700'];

    document.querySelectorAll('.nav-link').forEach(function (el) {
        el.classList.remove(...activeClasses);
        el.classList.add(...inactiveClasses);
    });
    if(typeof link === 'string') {
        const linkEl = document.querySelector(`[data-url="${link}"]`);
        linkEl.classList.add(...activeClasses);
    } else if(link) {
        link.classList.add(...activeClasses);
    }
}