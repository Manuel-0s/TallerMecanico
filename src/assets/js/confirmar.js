document.addEventListener('click', (e) => {
    const enlace = e.target.closest('.js-confirmar');
    if (!enlace) return;

    e.preventDefault(); 

    Swal.fire({
        title: enlace.dataset.titulo,
        text: enlace.dataset.mensaje,
        icon: enlace.dataset.icono ,
        showCancelButton: true,
        confirmButtonText: enlace.dataset.confirmar || 'Sí, continuar',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#dc3545',
        reverseButtons: true
    }).then((resultado) => {
        if (resultado.isConfirmed) {
            window.location.href = enlace.href;
        }
    });
});