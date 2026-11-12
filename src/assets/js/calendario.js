document.addEventListener("DOMContentLoaded", function () {
    const etiquetas = {
        programada: 'Programadas',
        atendida:   'Atendidas',
        cancelada:  'Canceladas'
    };

    const calendarEl = document.getElementById("calendar");

    const calendar = new FullCalendar.Calendar(calendarEl, {
        editable: true,
        initialView: "timeGridWeek",
        locale: 'es',
        nowIndicator: true,
        timeZone: 'local',
        slotMinTime: '08:00:00', 
        slotMaxTime: '20:00:00', 
        
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridDay,timeGridWeek,dayGridMonth,listWeek'
        },
        events: '/admin/api/cita/index.php',

        eventClick: function (info) {
            const ev = info.event;
            const p = ev.extendedProps;
            const fecha = ev.start.toLocaleString('es-MX', { dateStyle: 'full', timeStyle: 'short' });
            const programada = p.estatus === 'programada';

            Swal.fire({
                title: ev.title,
                html: 
                `
                    <p class="mb-0 text-capitalize"><strong>Fecha:</strong> ${fecha}</p>
                    <p class="mb-0 text-capitalize"><strong>Estatus:</strong> ${p.estatus}</p>
                    <p class="mb-0 text-capitalize"><strong>Teléfono:</strong> ${p.telefono}</p>
                    <p class="mb-0 text-capitalize"><strong>Correo:</strong> ${p.correo}</p>
                    <p class="mb-0 text-capitalize"><strong>Marca:</strong> ${p.marca}</p>
                    <p class="mb-0 text-capitalize"><strong>Modelo:</strong> ${p.modelo}</p>
                    <p class="mb-0 text-capitalize"><strong>Año:</strong> ${p.anio}</p>
                `,
                showConfirmButton: programada,
                confirmButtonText: 'Generar Orden',
                confirmButtonColor: '#198754',
                showDenyButton: programada,
                denyButtonText: 'Cancelar cita',
                showCloseButton: true
            }).then(async (result) => {
                let nuevo = null;
                if (result.isConfirmed) nuevo = 'atendida';
                else if (result.isDenied) nuevo = 'cancelada';
                if (!nuevo) return;

                if (await cambiarEstatusCita(ev.id, nuevo)) {
                    calendar.refetchEvents(); 
                }
            });
        }
    });

    calendar.render();
});