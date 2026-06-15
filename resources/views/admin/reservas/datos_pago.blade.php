@extends('layouts.app')

@section('contenido')
<style>
    /* Usamos el mismo estilo unificado */
    body { background-color: #020617 !important; color: #ffffff; }
    
    .card-tramonto { 
        background-color: #1e293b !important; 
        border: 1px solid #334155 !important; 
        color: white; 
    }

    .btn-gold { 
        background-color: #d4af37 !important; 
        color: #020617 !important; 
        font-weight: bold; 
        text-transform: uppercase;
        border: none !important;
        transition: 0.3s;
    }
    .btn-gold:hover { 
        background-color: #c5a032 !important;
        transform: translateY(-2px);
    }

    /* Estilo de inputs oscuros */
    .form-control {
        background-color: #0f172a !important;
        color: white !important;
        border: 1px solid #475569 !important;
    }
    .form-control:focus {
        border-color: #d4af37 !important;
        box-shadow: 0 0 0 0.2rem rgba(212, 175, 55, 0.25);
    }

    .form-control::placeholder {
    color: #646970 !important; /* Un gris más claro y visible */
    opacity: 1 !important; /* Evita que el navegador lo haga transparente */
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-tramonto shadow-lg">
                <div class="card-header text-center border-0 py-3">
                    <h3 class="fw-bold" style="color: #d4af37;">Información de Pago</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('reservas.procesar_pago', $reserva->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label text-white">Nombre en la tarjeta</label>
                            <input type="text" class="form-control" required placeholder="Juan Pérez">
                        </div>
                        <div class="mb-3">
                                    <label class="form-label text-white">Número de tarjeta</label>
                                    <input type="text" 
                                        id="card_number"
                                        class="form-control" 
                                        required 
                                        placeholder="0000 0000 0000 0000" 
                                        maxlength="19" 
                                        oninput="formatCardNumber(this)">
                                </div>

                                <script>
                                function formatCardNumber(input) {
                                    // 1. Elimina todo lo que no sea número
                                    let value = input.value.replace(/\D/g, '');
                                    
                                    // 2. Agrupa de a 4 dígitos
                                    let formatted = value.match(/.{1,4}/g);
                                    
                                    // 3. Une con espacios
                                    input.value = formatted ? formatted.join(' ') : '';
                                }
                                </script>
                       <div class="col-6 mb-3">
                            <label class="form-label text-white">Vencimiento</label>
                            <input type="text" 
                                id="expiry_date"
                                class="form-control" 
                                required 
                                placeholder="MM/AA" 
                                maxlength="5" 
                                oninput="formatExpiry(this)">
                        </div>

                        <script>
                        function formatExpiry(input) {
                            // 1. Elimina todo lo que no sea número
                            let value = input.value.replace(/\D/g, '');
                            
                            // 2. Si hay más de 2 dígitos, inserta la barra
                            if (value.length > 2) {
                                input.value = value.slice(0, 2) + '/' + value.slice(2, 4);
                            } else {
                                input.value = value;
                            }
                        }
                    </script>
                          <div class="col-6 mb-3">
                                <label class="form-label text-white">CVV</label>
                                <input type="password" 
                                    class="form-control" 
                                    placeholder="•••" 
                                    maxlength="3" 
                                    required
                                    oninput="this.value = this.value.replace(/\D/g, '')">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-gold w-100 py-3 mt-3 shadow">
                            Confirmar y Pagar ${{ number_format($reserva->total, 2) }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection