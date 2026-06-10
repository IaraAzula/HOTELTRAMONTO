@extends('layouts.app')

@section('contenido')
<style>
    body { background-color: #020617 !important; color: #ffffff; }
    .text-gold-tramonto { color: #d4af37 !important; }
    .card-tramonto { 
        background-color: rgba(15, 23, 42, 0.6) !important; 
        border: 1px solid rgba(212, 175, 55, 0.2) !important; 
        border-radius: 12px; 
    }
    #calendario { max-width: 100%; }
    .fc { color: #ffffff; }
    .fc-toolbar-title { color: #d4af37 !important; }
    .fc-button { background-color: transparent !important; border: 1px solid #d4af37 !important; color: #d4af37 !important; }
    .fc-button:hover { background-color: #d4af37 !important; color: #020617 !important; }
    .fc-button-active { background-color: #d4af37 !important; color: #020617 !important; }
    .fc-daygrid-day { background-color: rgba(15, 23, 42, 0.4) !important; }
    .fc-daygrid-day:hover { background-color: rgba(212, 175, 55, 0.05) !important; }
    .fc-col-header-cell { background-color: rgba(15, 23, 42, 0.8) !important; color: #d4af37 !important; }
    .fc-col-header-cell-cushion { color: #d4af37 !important; }
    .fc-daygrid-day-number { color: #ffffff !important; }
    .fc-day-today { background-color: rgba(212, 175, 55, 0.1) !important; }
</style>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold text-gold-tramonto m-0"><i class="bi bi-calendar3 me-2"></i>Calendario de Reservas</h1>
            <p class="text-white small">Vista de ocupación del Hotel Tramonto</p>
        </div>
        <a href="{{ route('admin.ventas') }}" class="btn btn-sm" style="color: #d4af37; border: 1px solid rgba(212,175,55,0.5);">
            <i class="bi bi-list-ul me-1"></i> Ver lista
        </a>
    </div>

    <div class="card-tramonto p-4">
        <div id="calendario"></div>
    </div>
</div>

{{-- FullCalendar --}}
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const reservas = @json($reservas);
    
    const eventos = [];
    
    reservas.forEach(reserva => {
        const nombre = reserva.usuario ? reserva.usuario.nombre : 'Cliente #' + reserva.usuario_id;
        const habitacion = reserva.detalles && reserva.detalles[0] && reserva.detalles[0].habitacion 
            ? reserva.detalles[0].habitacion.nombre 
            : 'Habitación';
        
        eventos.push({
            title: nombre + ' - ' + habitacion,
            start: reserva.fecha_entrada,
            end: reserva.fecha_salida,
            backgroundColor: '#c0392b',
            borderColor: '#e74c3c',
            textColor: '#ffffff',
            url: '/admin/reservas/' + reserva.id,
            extendedProps: {
                total: reserva.total,
                estado: reserva.estado
            }
        });
    });

    const calendarEl = document.getElementById('calendario');
    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,dayGridWeek'
        },
        events: eventos,
        eventClick: function(info) {
            info.jsEvent.preventDefault();
            if (info.event.url) {
                window.location.href = info.event.url;
            }
        },
        eventMouseEnter: function(info) {
            info.el.style.cursor = 'pointer';
        }
    });
    
    calendar.render();
});
</script>
@endsection