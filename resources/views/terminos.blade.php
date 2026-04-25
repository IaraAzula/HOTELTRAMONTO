@extends('layouts.app')

@section('contenido')
<style>
    .bg-main-tramonto {
        background-color: #020617;
        color: #ffffff;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .text-gold-tramonto {
        color: #d4af37 !important;
    }
    .terminos-container {
        background-color: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(212, 175, 55, 0.3);
        border-radius: 12px;
        padding: 40px;
        line-height: 1.8;
    }
    .section-title {
        color: #d4af37;
        font-weight: bold;
        margin-top: 25px;
        border-bottom: 1px solid rgba(212, 175, 55, 0.2);
        display: inline-block;
        padding-bottom: 5px;
    }
    ul li {
        margin-bottom: 10px;
    }
</style>

<div class="container-fluid bg-main-tramonto min-vh-100 py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold text-gold-tramonto">Términos y Usos</h1>
            <div class="badge bg-secundary text-white p-2 mt-2">
                AVISO LEGAL - HOTEL TRAMONTO - EMPEDRADO, CORRIENTES
            </div>
        </div>

        <div class="terminos-container shadow-lg">
            
            <h5 class="section-title">1. Aceptación de los términos</h5>
            <p>El acceso y uso del sitio web del Hotel Tramonto implica la aceptación plena de los presentes Términos y Usos. En caso de no estar de acuerdo, el usuario deberá abstenerse de utilizar el sitio.</p>

            <h5 class="section-title">2. Objeto del sitio</h5>
            <p>El sitio web tiene como finalidad:</p>
            <ul>
                <li>Brindar información sobre el hotel, sus instalaciones y servicios.</li>
                <li>Permitir la consulta y reserva de alojamiento y servicios asociados.</li>
                <li>Facilitar el contacto con el establecimiento.</li>
            </ul>

            <h5 class="section-title">3. Uso del sitio web</h5>
            <p>El usuario se compromete a:</p>
            <ul>
                <li>Utilizar el sitio de manera lícita y conforme a la normativa vigente.</li>
                <li>No realizar actividades que puedan dañar, sobrecargar o afectar el funcionamiento del sitio.</li>
                <li>No introducir virus, malware o cualquier otro sistema dañino.</li>
            </ul>
            <p>El hotel podrá restringir el acceso a usuarios que incumplan estas condiciones.</p>

            <h5 class="section-title">4. Servicios ofrecidos</h5>
            <p>El Hotel Tramonto ofrece servicios de:</p>
            <ul>
                <li>Alojamiento.</li>
                <li>Gastronomía.</li>
                <li>Actividades recreativas (ej. pesca guiada, spa, etc.).</li>
            </ul>
            <p>Todos los servicios están sujetos a disponibilidad, condiciones climáticas y operativas.</p>

            <h5 class="section-title">5. Proceso de reserva y compra</h5>
            <ul>
                <li>Las reservas se realizan a través del sitio web, canales oficiales o plataformas externas.</li>
                <li>La confirmación requiere el pago total o parcial según la política vigente.</li>
                <li>El usuario recibirá confirmación por medios electrónicos.</li>
            </ul>

            <h5 class="section-title">6. Precios y formas de pago</h5>
            <ul>
                <li>Los precios están expresados en la moneda indicada (ARS/USD).</li>
                <li>Pueden incluir o no impuestos (especificar en cada caso).</li>
                <li>Se aceptan medios de pago como transferencias, tarjetas y/o efectivo.</li>
            </ul>
            <p>El hotel se reserva el derecho de modificar precios sin previo aviso.</p>

            <h5 class="section-title">7. Cancelaciones, cambios y no presentación</h5>
            <ul>
                <li>Las cancelaciones deben realizarse dentro de los plazos establecidos.</li>
                <li>Fuera de término, puede aplicarse penalización o pérdida total de la seña.</li>
                <li>La no presentación (no-show) implica el cobro total de la reserva.</li>
            </ul>

            <h5 class="section-title">8. Políticas de entrega del servicio</h5>
            <p>El servicio de alojamiento se considera “entregado” al momento del check-in.</p>
            <p><strong>Horarios:</strong><br>
               Check-in: 14:00 hs<br>
               Check-out: 10:00 hs (Ajustar según política real)</p>

            <h5 class="section-title">9. Garantías y calidad del servicio</h5>
            <p>El hotel garantiza la prestación del servicio conforme a lo ofrecido y condiciones adecuadas de higiene y seguridad. En caso de inconvenientes, el usuario podrá realizar reclamos durante su estadía.</p>

            <h5 class="section-title">10. Soporte y atención postventa</h5>
            <p>Para consultas o reclamos, el usuario podrá comunicarse a través de teléfono, correo electrónico o redes sociales oficiales. El hotel brindará respuesta dentro de un plazo razonable.</p>

            <h5 class="section-title">11. Política de privacidad</h5>
            <p>Los datos personales se recopilan para gestionar reservas y brindar atención. No serán compartidos con terceros sin consentimiento y serán protegidos conforme a la normativa vigente.</p>

            <h5 class="section-title">12. Propiedad intelectual</h5>
            <p>Todos los contenidos del sitio (textos, imágenes, logos, diseño) son propiedad del Hotel Tramonto. Queda prohibida su reproducción sin autorización.</p>

            <h5 class="section-title">13. Limitación de responsabilidad</h5>
            <p>El hotel no será responsable por daños derivados del uso indebido del sitio, interrupciones técnicas o factores externos (clima, fuerza mayor).</p>

            <h5 class="section-title">14. Modificaciones</h5>
            <p>El hotel podrá modificar estos términos en cualquier momento. Los cambios entrarán en vigencia desde su publicación.</p>

            <h5 class="section-title">15. Legislación aplicable</h5>
            <p>Los presentes términos se rigen por las leyes de la República Argentina. Cualquier conflicto será resuelto por los tribunales competentes de la provincia de Corrientes.</p>
        </div>
    </div>
</div>
@endsection