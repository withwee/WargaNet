<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Iuran;

class PaymentController extends Controller
{
    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $signatureKey = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
    
        if ($signatureKey !== $request->signature_key) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }
    
        if ($request->transaction_status === 'settlement') {
            $iuran = Iuran::where('id_bayar', $request->order_id)->first();
            if ($iuran) {
                $iuran->status = 'Sudah Bayar';
                $iuran->tgl_bayar = now();
                $iuran->save();
            }
        }
    
        return response()->json(['message' => 'Callback handled']);
    }
}