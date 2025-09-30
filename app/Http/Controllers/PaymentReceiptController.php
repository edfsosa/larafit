<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class PaymentReceiptController extends Controller
{
    public function download(Payment $payment)
    {
        $member = Auth::user()->member;

        // Seguridad: verificar que el pago pertenece al miembro autenticado
        if ($payment->memberMembership->member_id !== $member->id) {
            abort(403);
        }

        $pdf = Pdf::loadView('pdf.payment-receipt', [
            'payment' => $payment->load('memberMembership.membership'),
            'member' => $member,
        ]);

        return $pdf->stream('comprobante-pago-' . $payment->id . '.pdf');
    }
}
