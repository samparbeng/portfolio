// js/script.js
document.addEventListener('DOMContentLoaded', () => {
    const images = document.querySelectorAll('.portfolio-item img');
    images.forEach(img => {
        img.addEventListener('click', () => {
            alert(`You clicked on ${img.alt}`);
        });
    });
});
