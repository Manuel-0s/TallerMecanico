(() => {
    const TAMANO = 480; // lado de la foto cuadrada en px

    // Elementos
    const input      = document.getElementById('foto-input');
    const preview    = document.getElementById('foto-preview');
    const btnSubir   = document.getElementById('btn-subir-foto');
    const modalEl    = document.getElementById('modal-camara');
    const video      = document.getElementById('camara-video');
    const canvas     = document.getElementById('camara-canvas');
    const errorEl    = document.getElementById('camara-error');
    const btnCapturar = document.getElementById('btn-capturar');
    const btnRepetir  = document.getElementById('btn-repetir');
    const btnUsar     = document.getElementById('btn-usar-foto');

    let stream = null;

    // ---------- Vista previa ----------
    function mostrarVistaPrevia(archivo) {
        preview.src = URL.createObjectURL(archivo);
    }

    // ---------- Subir desde el dispositivo ----------
    btnSubir.addEventListener('click', () => input.click());

    input.addEventListener('change', () => {
        if (input.files[0]) mostrarVistaPrevia(input.files[0]);
    });

    // ---------- Cámara ----------
    async function iniciarCamara() {
        errorEl.classList.add('d-none');
        try {
            stream = await navigator.mediaDevices.getUserMedia({
                video: { facingMode: 'user' },
                audio: false
            });
            video.srcObject = stream;
        } catch (e) {
            errorEl.textContent = 'No se pudo acceder a la cámara. Revisa los permisos del navegador.';
            errorEl.classList.remove('d-none');
        }
    }

    function detenerCamara() {
        if (stream) {
            stream.getTracks().forEach(t => t.stop());
            stream = null;
        }
    }

    function mostrarModoVideo(activo) {
        video.classList.toggle('d-none', !activo);
        canvas.classList.toggle('d-none', activo);
        btnCapturar.classList.toggle('d-none', !activo);
        btnRepetir.classList.toggle('d-none', activo);
        btnUsar.classList.toggle('d-none', activo);
    }

    // Recorta al centro para obtener una imagen cuadrada
    function capturar() {
        const lado = Math.min(video.videoWidth, video.videoHeight);
        const x = (video.videoWidth - lado) / 2;
        const y = (video.videoHeight - lado) / 2;

        canvas.width = canvas.height = TAMANO;
        canvas.getContext('2d').drawImage(video, x, y, lado, lado, 0, 0, TAMANO, TAMANO);
        mostrarModoVideo(false);
    }

    // Convierte el canvas en File y lo coloca en el input del formulario
    function usarFoto() {
        canvas.toBlob(blob => {
            const archivo = new File([blob], 'foto-empleado.jpg', { type: 'image/jpeg' });
            const transferencia = new DataTransfer();
            transferencia.items.add(archivo);
            input.files = transferencia.files;

            mostrarVistaPrevia(archivo);
            bootstrap.Modal.getInstance(modalEl).hide();
        }, 'image/jpeg', 0.9);
    }

    // ---------- Eventos del modal ----------
    modalEl.addEventListener('shown.bs.modal', () => {
        mostrarModoVideo(true);
        iniciarCamara();
    });
    modalEl.addEventListener('hidden.bs.modal', detenerCamara);

    btnCapturar.addEventListener('click', capturar);
    btnRepetir.addEventListener('click', () => mostrarModoVideo(true));
    btnUsar.addEventListener('click', usarFoto);
})();