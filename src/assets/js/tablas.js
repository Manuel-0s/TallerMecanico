document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('table.js-datatable').forEach(tabla => {
        new DataTable(tabla, {
            language: {
                url: 'https://cdn.datatables.net/plug-ins/2.1.8/i18n/es-MX.json'
            },
            ordering: {
                indicators: false,
                handler: false
            },
            pageLength: 10,
            columnDefs: [
                { targets: '.con-filtro', columnControl: ['order', ['searchList']] },
                { targets: '.con-fecha', columnControl: ['order', ['searchDateTime']] },
                { targets: '.no-orden', orderable: false, searchable: false, columnControl: [] }
            ]
        });
    });
});