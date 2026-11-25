document.addEventListener("DOMContentLoaded", function () {
    const API = '/admin/api/cita/index.php';

    const estatusUI = {
        programada: { texto: 'Programada', clase: 'primary', icono: 'fa-clock' },
        atendida:   { texto: 'Atendida',   clase: 'success', icono: 'fa-circle-check' },
        cancelada:  { texto: 'Cancelada',  clase: 'danger',  icono: 'fa-ban' }
    };
    const uiPorDefecto = { texto: 'Sin estatus', clase: 'secondary', icono: 'fa-circle' };

    const activos = new Set(['programada', 'atendida', 'cancelada']);
    let citas = [];

    // ---------- Utilidades ----------
    const $ = (id) => document.getElementById(id);

    const esc = (v) => String(v ?? '').replace(/[&<>"']/g, (c) => (
        { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]
    ));

    // Acepta Date o "YYYY-MM-DD HH:MM:SS"
    const parseFecha = (s) => s instanceof Date ? s : new Date(String(s).replace(' ', 'T'));
    const mismoDia = (a, b) => a.toDateString() === b.toDateString();
    const hora = (d) => d.toLocaleTimeString('es-MX', { hour: '2-digit', minute: '2-digit' });
    const visible = (c) => activos.has(c.extendedProps.estatus);

    const toast = (icon, title) => Swal.fire({
        toast: true, position: 'top-end', icon, title,
        showConfirmButton: false, timer: 2500, timerProgressBar: true
    });

    // ---------- Datos ----------
    async function cargar() {
        const res = await fetch(API, { headers: { Accept: 'application/json' } });
        if (!res.ok) throw new Error('No se pudieron cargar las citas');
        const datos = await res.json();
        // "YYYY-MM-DD HH:MM:SS" -> ISO con "T", para que FullCalendar lo trate como cita con hora (no "All-day")
        citas = datos.map((c) => ({ ...c, start: String(c.start).replace(' ', 'T') }));
        renderPanel();
        return citas;
    }

    async function cambiarEstatus(id, nuevo, confirmar) {
        if (confirmar && nuevo === 'cancelada') {
            const r = await Swal.fire({
                title: '¿Cancelar esta cita?',
                text: 'El estatus cambiará a cancelada.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, cancelar',
                cancelButtonText: 'Volver',
                confirmButtonColor: '#dc3545',
                reverseButtons: true
            });
            if (!r.isConfirmed) return false;
        }

        try {
            const res = await fetch(`${API}?id=${encodeURIComponent(id)}`, {
                method: 'POST',
                body: new URLSearchParams({ estatus: nuevo })
            });
            const data = await res.json();
            if (!data.ok) throw new Error();

            toast('success', nuevo === 'atendida' ? 'Cita marcada como atendida' : 'Cita cancelada');
            calendar.refetchEvents(); // recarga calendario y panel
            return true;
        } catch (e) {
            toast('error', 'No se pudo actualizar la cita');
            return false;
        }
    }

    // ---------- Detalle (modal) ----------
    function abrirDetalle(c) {
        const p = c.extendedProps;
        const ui = estatusUI[p.estatus] ?? uiPorDefecto;
        const programada = p.estatus === 'programada';
        const fecha = parseFecha(c.start).toLocaleString('es-MX', { dateStyle: 'full', timeStyle: 'short' });
        const servicios = (p.servicios ?? []).map(esc).join(', ');

        Swal.fire({
            title: esc(c.title),
            html: `
                <span class="badge rounded-pill text-bg-${ui.clase} px-3 py-2 mb-3">
                    <i class="fa-solid ${ui.icono} me-1"></i> ${ui.texto}
                </span>
                <ul class="list-unstyled text-start mb-0">
                    <li class="py-1"><i class="fa-solid fa-calendar-day me-2"></i>${esc(fecha)}</li>
                    <li class="py-1"><i class="fa-solid fa-phone me-2"></i>${esc(p.telefono)}</li>
                    <li class="py-1"><i class="fa-solid fa-envelope me-2"></i>${esc(p.correo)}</li>
                    <li class="py-1"><i class="fa-solid fa-car me-2"></i>${esc(p.marca)} ${esc(p.modelo)} · ${esc(p.anio)}</li>
                    ${servicios ? `<li class="py-1"><i class="fa-solid fa-wrench me-2"></i>${servicios}</li>` : ''}
                </ul>
            `,
            showConfirmButton: programada,
            confirmButtonText: 'Marcar atendida',
            confirmButtonColor: '#198754',
            showDenyButton: programada,
            denyButtonText: 'Cancelar cita',
            showCloseButton: true
        }).then((result) => {
            const nuevo = result.isConfirmed ? 'atendida'
                        : result.isDenied ? 'cancelada'
                        : null;
            if (nuevo) cambiarEstatus(c.id, nuevo, false);
        });
    }

    // ---------- Panel lateral ----------
    function itemCita(c, mostrarFecha) {
        const p = c.extendedProps;
        const ui = estatusUI[p.estatus] ?? uiPorDefecto;
        const f = parseFecha(c.start);
        const programada = p.estatus === 'programada';

        const cuando = mostrarFecha
            ? f.toLocaleDateString('es-MX', { weekday: 'short', day: 'numeric', month: 'short' }) + ' · ' + hora(f)
            : hora(f);

        const servicios = (p.servicios ?? [])
            .map((s) => `<span class="badge text-bg-light border fw-normal">${esc(s)}</span>`)
            .join(' ');

        const acciones = programada ? `
            <button type="button" class="btn btn-outline-success btn-sm" data-accion="atender" data-id="${esc(c.id)}" title="Marcar atendida">
                <i class="fa-solid fa-check"></i>
            </button>
            <button type="button" class="btn btn-outline-danger btn-sm" data-accion="cancelar" data-id="${esc(c.id)}" title="Cancelar cita">
                <i class="fa-solid fa-xmark"></i>
            </button>` : '';

        return `
            <div class="list-group-item list-group-item-action px-3 py-3 js-agenda-item" role="button" data-id="${esc(c.id)}">
                <div class="d-flex justify-content-between align-items-start gap-2">
                    <div class="text-truncate">
                        <div class="small fw-semibold text-${ui.clase}">${esc(cuando)}</div>
                        <div class="fw-semibold text-truncate">${esc(c.title)}</div>
                        <div class="small text-secondary text-truncate">${esc(p.marca)} ${esc(p.modelo)}</div>
                    </div>
                    <span class="badge rounded-pill bg-${ui.clase}-subtle text-${ui.clase}-emphasis flex-shrink-0">
                        <i class="fa-solid ${ui.icono}"></i> ${ui.texto}
                    </span>
                </div>
                ${servicios ? `<div class="d-flex flex-wrap gap-1 mt-2">${servicios}</div>` : ''}
                <div class="d-flex gap-1 mt-2">
                    ${acciones}
                    <a href="cita.php?accion=pdf&id=${encodeURIComponent(c.id)}" class="btn btn-outline-secondary btn-sm" title="Comprobante PDF">
                        <i class="fa-solid fa-file-pdf"></i>
                    </a>
                </div>
            </div>`;
    }

    const vacio = (icono, texto) => `
        <div class="list-group-item text-center text-secondary py-4">
            <i class="fa-solid ${icono} fa-lg mb-2 d-block opacity-50"></i>${texto}
        </div>`;

    function renderPanel() {
        const hoy = new Date();
        const manana = new Date(hoy.getFullYear(), hoy.getMonth(), hoy.getDate() + 1);
        const porFecha = (a, b) => parseFecha(a.start) - parseFecha(b.start);

        $('fecha-hoy').textContent = hoy.toLocaleDateString('es-MX', { weekday: 'long', day: 'numeric', month: 'long' });

        // Resumen (sin filtros, refleja el día completo)
        const delDia = citas.filter((c) => mismoDia(parseFecha(c.start), hoy));
        $('resumen-total').textContent = delDia.length;
        $('resumen-programadas').textContent = delDia.filter((c) => c.extendedProps.estatus === 'programada').length;
        $('resumen-atendidas').textContent = delDia.filter((c) => c.extendedProps.estatus === 'atendida').length;

        // Agenda de hoy (con filtros)
        const hoyLista = delDia.filter(visible).sort(porFecha);
        $('badge-hoy').textContent = hoyLista.length;
        $('agenda-hoy').innerHTML = hoyLista.length
            ? hoyLista.map((c) => itemCita(c, false)).join('')
            : vacio('fa-mug-hot', 'No hay citas para hoy.');

        // Próximas (programadas desde mañana)
        const proximas = citas
            .filter((c) => c.extendedProps.estatus === 'programada' && visible(c) && parseFecha(c.start) >= manana)
            .sort(porFecha)
            .slice(0, 20);
        $('badge-proximas').textContent = proximas.length;
        $('agenda-proximas').innerHTML = proximas.length
            ? proximas.map((c) => itemCita(c, true)).join('')
            : vacio('fa-calendar-check', 'No hay citas próximas.');
    }

    // Acciones rápidas y apertura de detalle (delegación de eventos)
    $('panel-agenda').addEventListener('click', (e) => {
        const boton = e.target.closest('[data-accion]');
        if (boton) {
            const nuevo = boton.dataset.accion === 'atender' ? 'atendida' : 'cancelada';
            cambiarEstatus(boton.dataset.id, nuevo, true);
            return;
        }
        if (e.target.closest('a')) return; // enlace al PDF

        const item = e.target.closest('.js-agenda-item');
        if (!item) return;
        const cita = citas.find((c) => String(c.id) === item.dataset.id);
        if (cita) abrirDetalle(cita);
    });

    // Filtros por estatus: afectan calendario y listas
    document.querySelectorAll('.js-filtro-estatus').forEach((cb) => {
        cb.addEventListener('change', () => {
            cb.checked ? activos.add(cb.value) : activos.delete(cb.value);
            calendar.refetchEvents();
        });
    });

    // ---------- Calendario ----------
    const calendar = new FullCalendar.Calendar($('calendar'), {
        initialView: window.innerWidth < 992 ? 'listWeek' : 'timeGridWeek',
        locale: 'es',
        nowIndicator: true,
        timeZone: 'local',
        slotMinTime: '08:00:00',
        slotMaxTime: '20:00:00',
        height: 680,

        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'timeGridWeek,dayGridMonth,listWeek'
        },

        events: async () => (await cargar()).filter(visible),

        eventClick: function (info) {
            const ev = info.event;
            abrirDetalle({
                id: ev.id,
                title: ev.title,
                start: ev.start,
                extendedProps: ev.extendedProps
            });
        }
    });

    calendar.render();
});