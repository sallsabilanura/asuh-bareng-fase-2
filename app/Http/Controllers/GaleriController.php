<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AbsensiPendampingan;
use Illuminate\Support\Facades\Auth;

class GaleriController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil absensi yang memiliki foto bukti
        $query = AbsensiPendampingan::with(['anakAsuh', 'kakakAsuh.user'])
                    ->whereNotNull('FotoBukti')
                    ->where('FotoBukti', '!=', '');

        // Jika login sebagai kakak asuh, mungkin hanya melihat galerinya sendiri?
        // Tapi galeri biasanya untuk melihat semua kegiatan. Kita akan tampilkan semua.
        
        $galeri = $query->orderBy('Tanggal', 'desc')->paginate(12);

        return view('galeri.index', compact('galeri'));
    }
}
