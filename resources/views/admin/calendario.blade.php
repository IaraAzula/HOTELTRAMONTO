@extends('layouts.app')

@section('contenido')

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