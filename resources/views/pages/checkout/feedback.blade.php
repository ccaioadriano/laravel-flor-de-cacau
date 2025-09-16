@extends('layouts.main')

@section('content')
    <div class="container text-center">
        <h2>Obrigado pela compra!</h2>
        <p id="payment-status">Estamos confirmando seu pagamento...</p>
    </div>
@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Aguarda um pouco para garantir que o app.js terminou
            setTimeout(() => {
                if (window.Echo) {
                    console.log("Echo disponível:", window.Echo);

                    Echo.channel('orders.{{ $order->order_number }}')
                        .listen('.OrderStatusUpdated', (e) => {
                            console.log("Evento recebido:", e);
                            let statusElement = document.getElementById('payment-status');

                            switch (e.order.status) {
                                case 'processing':
                                    statusElement.innerHTML = "Seu pagamento está sendo processado...";
                                    break;
                                case 'paid':
                                    statusElement.innerHTML = "Pagamento aprovado 🎉";
                                    break;
                                case 'failed':
                                    statusElement.innerHTML = "Ops, pagamento não foi concluído 🚫";
                                    break;
                            }
                        });
                } else {
                    console.error("Echo ainda não está disponível");
                }
            }, 100);
        });
    </script>
@endpush