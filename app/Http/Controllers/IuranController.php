<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Iuran;
use App\Models\User;

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

        $iurans = Iuran::where('no_kk', $no_kk)->get();
        $user = User::where('no_kk', $no_kk)->first();

        return view('pay', compact('iurans', 'user', 'no_kk'));
    }

    public function bayar($id)
    {
        $iuran = Iuran::find($id);
        $iuran->status = 'Sudah Bayar';
        $iuran->tgl_bayar = now();
        $iuran->save();

        return redirect()->back()->with('success', 'Pembayaran berhasil.');
    }
}
