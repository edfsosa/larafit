<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Comprobante de Pago</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        h1,
        h2,
        h3 {
            margin-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            padding: 6px;
            text-align: left;
        }
    </style>
</head>

<body>
    <h1>Comprobante de Pago</h1>

    <p><strong>Miembro:</strong> {{ $member->getFullNameAttribute() }}</p>
    <p><strong>Documento:</strong> {{ $member->getDocumentNumberAttribute() }}</p>

    <hr>

    <p><strong>Membresía:</strong> {{ $payment->memberMembership->membership->name }}</p>
    <p><strong>Descripción:</strong> {{ $payment->memberMembership->membership->description }}</p>

    <hr>

    <p><strong>Monto:</strong> Gs. {{ number_format($payment->amount, 0, ',', '.') }}</p>
    <p><strong>Método de pago:</strong> {{ $payment->method }}</p>
    <p><strong>Fecha de pago:</strong> {{ \Carbon\Carbon::parse($payment->date)->format('d/m/Y') }}</p>
    @if ($payment->notes)
        <p><strong>Notas:</strong> {{ $payment->notes }}</p>
    @endif

    <hr>
    <p style="font-size: 10px; margin-top: 20px;">Gracias por su pago. Guarde este comprobante como respaldo.</p>
</body>

</html>
