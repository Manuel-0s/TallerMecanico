document.addEventListener("DOMContentLoaded", function () {
    const estatusUI = {
        programada: { texto: 'Programada', clase: 'primary', icono: 'fa-clock' },
        atendida:   { texto: 'Atendida', clase: 'success', icono: 'fa-circle-check' },
        cancelada:  { texto: 'Cancelada', clase: 'danger', icono: 'fa-ban' }
    };

    const calendar = new FullCalendar.Calendar(document.getElementById("calendar"), {
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
            const ui = estatusUI[p.estatus];
            const programada = p.estatus === 'programada';

            const fecha = ev.start.toLocaleString('es-MX', {
                dateStyle: 'full',
                timeStyle: 'short'
            });

            Swal.fire({
                title: ev.title,
                html: `
                    <span class="badge rounded-pill text-bg-${ui.clase} px-3 py-2 mb-3">
                        <i class="fa-solid ${ui.icono} me-1"></i> ${ui.texto}
                    </span>
                    <ul class="list-unstyled text-start mb-0">
                        <li class="py-1"><i class="fa-solid fa-calendar-day me-2"></i>${fecha}</li>
                        <li class="py-1"><i class="fa-solid fa-phone me-2"></i>${p.telefono}</li>
                        <li class="py-1"><i class="fa-solid fa-envelope me-2"></i>${p.correo}</li>
                        <li class="py-1"><i class="fa-solid fa-car me-2"></i>${p.marca} ${p.modelo} · ${p.anio}</li>
                    </ul>
                `,
                showConfirmButton: programada,
                confirmButtonText: 'Marcar atendida',
                confirmButtonColor: '#198754',
                showDenyButton: programada,
                denyButtonText: 'Cancelar cita',
                showCloseButton: true
            }).then(async (result) => {
                const nuevo = result.isConfirmed ? 'atendida'
                            : result.isDenied ? 'cancelada'
                            : null;

                if (nuevo && await confirmarEstatus(ev.id, nuevo)) {
                    calendar.refetchEvents();
                }
            });
        }
    });

    calendar.render();
});