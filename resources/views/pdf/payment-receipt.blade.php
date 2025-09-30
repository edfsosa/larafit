<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Comprobante de Pago</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            color: #333;
            padding: 20px;
        }

        h1 {
            font-size: 20px;
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }

        p {
            margin: 5px 0;
        }

        .section {
            margin-bottom: 20px;
        }

        .section-title {
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 15px;
            text-decoration: underline;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .info-table td {
            padding: 8px;
            vertical-align: top;
        }

        .footer {
            font-size: 10px;
            text-align: center;
            margin-top: 40px;
            color: #777;
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }

        .badge {
            display: inline-block;
            padding: 3px 8px;
            background-color: #f3f3f3;
            border: 1px solid #999;
            border-radius: 4px;
            font-size: 11px;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <h1>Comprobante de Pago</h1>

    <div class="section">
        <div class="section-title">Datos del Miembro</div>
        <table class="info-table">
            <tr>
                <td><strong>Nombre:</strong></td>
                <td>{{ $member->getFullNameAttribute() }}</td>
            </tr>
            <tr>
                <td><strong>Documento:</strong></td>
                <td>{{ $member->getDocumentNumberAttribute() }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Detalles de la Membresía</div>
        <table class="info-table">
            <tr>
                <td><strong>Nombre:</strong></td>
                <td>{{ $payment->memberMembership->membership->name }}</td>
            </tr>
            <tr>
                <td><strong>Descripción:</strong></td>
                <td>{{ $payment->memberMembership->membership->description }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Información del Pago</div>
        <table class="info-table">
            <tr>
                <td><strong>Monto:</strong></td>
                <td>{{ $payment->getFormattedAmountAttribute() }}</td>
            </tr>
            <tr>
                <td><strong>Método de Pago:</strong></td>
                <td>{{ $payment->getMethodAttribute() }}</td>
            </tr>
            <tr>
                <td><strong>Fecha:</strong></td>
                <td>{{ $payment->getFormattedDateAttribute() }}</td>
            </tr>
            @if ($payment->notes)
                <tr>
                    <td><strong>Notas:</strong></td>
                    <td>{{ $payment->notes }}</td>
                </tr>
            @endif
        </table>
    </div>

    <div class="footer">
        Gracias por su pago.<br>
        Guarde este comprobante como respaldo.
    </div>
</body>

</html>
