document.addEventListener('DOMContentLoaded', function() {
    const footerColumns = document.querySelectorAll('.navigation-secondaire > section');

    footerColumns.forEach(column => {
        const heading = column.querySelector('h4');
        const list = column.querySelector('.footer-list');

        heading.addEventListener('click', function() {
            list.classList.toggle('active');
        });
    });
});
