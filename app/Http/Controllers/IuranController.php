<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Iuran;
use App\Models\User;
use Midtrans\Config;
use Midtrans\Snap;

class IuranController extends Controller
{
    public function index()
    {
        $iurans = [];
        $user = null;
        $no_kk = null;

        return view('pay', compact('iurans', 'user', 'no_kk'));
    }

    public function cari(Request $request)
    {
        $no_kk = $request->no_kk;

        // Cari user berdasarkan no_kk
        $user = User::where('no_kk', $no_kk)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Nomor KK tidak ditemukan.');
        }

        // Ambil iuran berdasarkan user_id
        $iurans = Iuran::where('user_id', $user->id)->get();

        return view('pay', compact('iurans', 'user', 'no_kk'));
    }

    public function createPaymentLink($id)
    {
        $iuran = Iuran::find($id);

        if (!$iuran) {
            return redirect()->back()->with('error', 'Data iuran tidak ditemukan.');
        }

        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Data untuk Payment Link
        $params = [
            'transaction_details' => [
                'order_id' => 'IURAN-' . $iuran->id_bayar . '-' . time(),
                'gross_amount' => $iuran->total_bayar,
            ],
            'item_details' => [
                [
                    'id' => $iuran->id_bayar,
                    'price' => $iuran->total_bayar,
                    'quantity' => 1,
                    'name' => $iuran->jenis_iuran,
                ],
            ],
            'customer_details' => [
                'first_name' => $iuran->user->name,
                'email' => $iuran->user->email,
            ],
        ];

        // Buat Payment Link
        try {
            $paymentLink = Snap::createTransaction($params);
            return redirect($paymentLink->redirect_url);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat Payment Link: ' . $e->getMessage());
        }
    }

public function getSnapToken($id)
{
    $iuran = Iuran::find($id);

    if (!$iuran) {
        return response()->json(['error' => 'Data iuran tidak ditemukan.'], 404);
    }

    if (!$iuran->user || !$iuran->user->name || !$iuran->user->email) {
        return response()->json(['error' => 'Data pengguna tidak lengkap.'], 400);
    }

    // Konfigurasi Midtrans
    Config::$serverKey = config('midtrans.server_key');
    Config::$isProduction = config('midtrans.is_production');
    Config::$isSanitized = true;
    Config::$is3ds = true;

    // Data untuk Payment Link
    $params = [
        'transaction_details' => [
            'order_id' => 'IURAN-' . $iuran->id_bayar . '-' . time(),
            'gross_amount' => $iuran->total_bayar,
        ],
        'customer_details' => [
            'first_name' => $iuran->user->name,
            'email' => $iuran->user->email,
        ],
    ];

    try {
        $snapToken = Snap::getSnapToken($params);
        return response()->json(['snapToken' => $snapToken]);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Gagal membuat Snap Token: ' . $e->getMessage()], 500);
    }
}

    public function bayar($id)
    {
        $iuran = Iuran::find($id);

        if (!$iuran) {
            return redirect()->back()->with('error', 'Data iuran tidak ditemukan.');
        }

        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Data transaksi
    $params = [
    'transaction_details' => [
        'order_id' => 'IURAN-' . $iuran->id_bayar . '-' . time(), // Ubah disini
        'gross_amount' => $iuran->total_bayar,
    ],
    'customer_details' => [
        'first_name' => $iuran->user->name,
        'email' => $iuran->user->email,
    ],
];


        // Buat transaksi
        $snapToken = Snap::getSnapToken($params);

        return view('pay', compact('snapToken', 'iuran'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'jenis_iuran' => 'required|string|max:255',
            'total_bayar' => 'required|numeric|min:0',
        ]);

        // Ambil semua data pengguna (nomor KK)
        $users = User::all();

        // Loop melalui setiap pengguna dan tambahkan data iuran
        foreach ($users as $user) {
            Iuran::create([
                'user_id' => $user->id,
                'jenis_iuran' => $request->jenis_iuran,
                'total_bayar' => $request->total_bayar,
                'status' => 'Belum Bayar',
            ]);
        }

        return redirect()->route('pay.index')->with('success', 'Data iuran berhasil ditambahkan untuk semua pengguna.');
    }
}