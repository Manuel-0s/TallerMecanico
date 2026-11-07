document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('select.js-tomselect').forEach(el => {
        new TomSelect(el, {
            placeholder: el.dataset.placeholder || 'Selecciona una opción...',
            maxOptions: null 
        });
    });
});