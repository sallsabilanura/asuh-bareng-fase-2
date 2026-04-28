<?php

use Illuminate\Support\Facades\Route;

/* |-------------------------------------------------------------------------- | Web Routes |-------------------------------------------------------------------------- | | Here is where you can register web routes for your application. These | routes are loaded by the RouteServiceProvider within a group which | contains the "web" middleware group. Now create something great! | */

use App\Http\Controllers\KakakAsuhController;
use App\Http\Controllers\PenugasanAsuhController;
use App\Http\Controllers\AbsensiPendampinganController;
use App\Http\Controllers\CekKesehatanController;
use App\Http\Controllers\AnakAsuhController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

// Pendaftaran Rekrutmen Public
Route::get('/rekrutmen/panduan', [\App\Http\Controllers\PublicRekrutmenController::class , 'panduan'])->name('rekrutmen.panduan');
Route::get('/rekrutmen/daftar', [\App\Http\Controllers\PublicRekrutmenController::class , 'create'])->name('rekrutmen.daftar');
Route::post('/rekrutmen/daftar', [\App\Http\Controllers\PublicRekrutmenController::class , 'store'])->name('rekrutmen.store');
Route::get('/rekrutmen/sukses', [\App\Http\Controllers\PublicRekrutmenController::class , 'sukses'])->name('rekrutmen.sukses');

Route::get('/dashboard', function (\Illuminate\Http\Request $request) {
    $user = \Illuminate\Support\Facades\Auth::user();

    if ($user->role === 'admin' || $user->role === 'superadmin') {
        $totalAnak = \App\Models\AnakAsuh::count();
        $absensiBulanIni = \App\Models\AbsensiPendampingan::whereMonth('Tanggal', now()->month)
            ->whereYear('Tanggal', now()->year)
            ->count();
        
        $pendingRekrutmen = \App\Models\PendaftarRekrutmen::count();
        $pendingProgram = \App\Models\RencanaProgram::where('Status', 'Menunggu')->count();
        $pendingLogbook = \App\Models\LogbookRelawan::where('StatusValidasi', 'Belum Diperiksa')->count();

        // Data Chart: Anak Asuh per Tahun
        $anakPerTahun = \App\Models\AnakAsuh::selectRaw('YEAR(created_at) as tahun, count(*) as total')
            ->groupBy('tahun')
            ->orderBy('tahun')
            ->get();
        
        $chartAnakLabels = $anakPerTahun->pluck('tahun');
        $chartAnakData = $anakPerTahun->pluck('total');

        // Data Chart: Penyaluran Dana per Bulan (Tahun Ini)
        $penyaluranPerBulan = \App\Models\Penyaluran::where('Tahun', date('Y'))
            ->selectRaw('Bulan, SUM(Nominal) as total')
            ->groupBy('Bulan')
            ->orderBy('Bulan')
            ->get();

        $chartPenyaluranLabels = [];
        $chartPenyaluranData = array_fill(0, 12, 0); // Initialize with 0s for 12 months

        foreach($penyaluranPerBulan as $p) {
            $chartPenyaluranData[$p->Bulan - 1] = $p->total;
        }
        
        for($m=1; $m<=12; $m++) {
            $chartPenyaluranLabels[] = \Carbon\Carbon::create()->month($m)->translatedFormat('M');
        }

        return view('dashboard', compact(
            'totalAnak', 'absensiBulanIni', 'pendingRekrutmen', 'pendingProgram', 'pendingLogbook',
            'chartAnakLabels', 'chartAnakData', 'chartPenyaluranLabels', 'chartPenyaluranData'
        ));
    }
    else {
        $kakakAsuh = $user->kakakAsuh;
        if ($kakakAsuh) {
            $totalAnak = \App\Models\PenugasanAsuh::where('KakakAsuhID', $kakakAsuh->KakakAsuhID)
                ->distinct('AnakAsuhID')
                ->count('AnakAsuhID');
            $absensiBulanIni = \App\Models\AbsensiPendampingan::where('KakakAsuhID', $kakakAsuh->KakakAsuhID)
                ->whereMonth('Tanggal', now()->month)
                ->whereYear('Tanggal', now()->year)
                ->count();
            
            $programAktif = \App\Models\RencanaProgram::where('KakakAsuhID', $kakakAsuh->KakakAsuhID)
                ->where('Status', 'Disetujui')
                ->count();
            $logbookPending = \App\Models\LogbookRelawan::whereHas('rencanaProgram', function($q) use ($kakakAsuh) {
                $q->where('KakakAsuhID', $kakakAsuh->KakakAsuhID);
            })->where('StatusValidasi', 'Belum Diperiksa')->count();

            return view('dashboard', compact('totalAnak', 'absensiBulanIni', 'programAktif', 'logbookPending'));
        }
        else {
            $totalAnak = 0;
            $absensiBulanIni = 0;
            return view('dashboard', compact('totalAnak', 'absensiBulanIni'));
        }
    }
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    // PDF Export Routes
    Route::get('/export-absensi', [AbsensiPendampinganController::class , 'exportPDF'])->name('absensi_pendampingan.export_pdf');
    Route::get('/export-kesehatan', [CekKesehatanController::class , 'exportPDF'])->name('cek_kesehatan.export_pdf');

    Route::resource('kakak_asuh', KakakAsuhController::class);
    Route::resource('penugasan_asuh', PenugasanAsuhController::class);
    Route::resource('absensi_pendampingan', AbsensiPendampinganController::class);
    Route::resource('cek_kesehatan', CekKesehatanController::class);

    // Kebiasaan Baik Modul
    Route::get('/kebiasaan-baik', [\App\Http\Controllers\KebiasaanBaikController::class , 'index'])->name('kebiasaan_baik.index');
    Route::get('/kebiasaan-baik/{id}/{month}/{year}', [\App\Http\Controllers\KebiasaanBaikController::class , 'form'])->name('kebiasaan_baik.form');
    Route::post('/kebiasaan-baik/{id}/{month}/{year}', [\App\Http\Controllers\KebiasaanBaikController::class , 'store'])->name('kebiasaan_baik.store');
    Route::get('/kebiasaan-baik/{id}/{month}/{year}/pdf', [\App\Http\Controllers\KebiasaanBaikController::class , 'exportPdf'])->name('kebiasaan_baik.pdf');

    // Rapor Asuh for Kakak Asuh / Admin
    Route::get('/rapor-asuh', [\App\Http\Controllers\RaporAsuhController::class , 'index'])->name('rapor_asuh.index');
    Route::get('/rapor-asuh/{id}/{semester}/{year}', [\App\Http\Controllers\RaporAsuhController::class , 'form'])->name('rapor_asuh.form');
    Route::post('/rapor-asuh/{id}/{semester}/{year}', [\App\Http\Controllers\RaporAsuhController::class , 'store'])->name('rapor_asuh.store');
    Route::get('/rapor-asuh/{id}/{semester}/{year}/pdf', [\App\Http\Controllers\RaporAsuhController::class , 'exportPdf'])->name('rapor_asuh.pdf');

    // Galeri dari Absensi Pendampingan
    Route::get('/galeri', [\App\Http\Controllers\GaleriController::class, 'index'])->name('galeri.index');

    // Anak Asuh Excel Routes
    Route::get('/anak_asuh/template', [AnakAsuhController::class , 'downloadTemplate'])->name('anak_asuh.template');
    Route::post('/anak_asuh/import', [AnakAsuhController::class , 'importExcel'])->name('anak_asuh.import');

    Route::resource('anak_asuh', AnakAsuhController::class);

    // Program Relawan & Logbook
    Route::resource('rencana-program', \App\Http\Controllers\RencanaProgramController::class);
    Route::post('rencana-program/{id}/update-status', [\App\Http\Controllers\RencanaProgramController::class , 'updateStatus'])->name('rencana-program.update_status');
    Route::post('logbook-relawan', [\App\Http\Controllers\LogbookRelawanController::class , 'store'])->name('logbook-relawan.store');
    Route::post('logbook-relawan/{id}/validate', [\App\Http\Controllers\LogbookRelawanController::class , 'validateLog'])->name('logbook-relawan.validate');
    Route::delete('logbook-relawan/{id}', [\App\Http\Controllers\LogbookRelawanController::class , 'destroy'])->name('logbook-relawan.destroy');

    // Donatur Management
    Route::resource('donatur', \App\Http\Controllers\DonaturController::class);

    // Penyaluran Dana
    Route::post('penyaluran/bulk', [\App\Http\Controllers\PenyaluranController::class , 'bulkGenerate'])->name('penyaluran.bulk');
    Route::get('penyaluran/export-pdf', [\App\Http\Controllers\PenyaluranController::class , 'exportPdf'])->name('penyaluran.export_pdf');
    Route::resource('penyaluran', \App\Http\Controllers\PenyaluranController::class);

    // Profile Routes
    Route::get('/profile', [ProfileController::class , 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class , 'update'])->name('profile.update');

    // Admin Only User Approvals
    Route::get('/users', [App\Http\Controllers\UserController::class , 'index'])->name('users.index');
    Route::post('/users/{user}/approve', [App\Http\Controllers\UserController::class , 'approve'])->name('users.approve');

    // Admin Rekrutmen
    Route::get('/admin/rekrutmen/pengaturan', [\App\Http\Controllers\AdminRekrutmenController::class , 'pengaturan'])->name('admin.rekrutmen.pengaturan');
    Route::post('/admin/rekrutmen/pengaturan', [\App\Http\Controllers\AdminRekrutmenController::class , 'updatePengaturan'])->name('admin.rekrutmen.pengaturan.update');

    Route::get('/admin/rekrutmen/posisi', [\App\Http\Controllers\AdminRekrutmenController::class , 'posisiIndex'])->name('admin.rekrutmen.posisi.index');
    Route::post('/admin/rekrutmen/posisi', [\App\Http\Controllers\AdminRekrutmenController::class , 'posisiStore'])->name('admin.rekrutmen.posisi.store');
    Route::get('/admin/rekrutmen/posisi/{id}/edit', [\App\Http\Controllers\AdminRekrutmenController::class , 'posisiEdit'])->name('admin.rekrutmen.posisi.edit');
    Route::put('/admin/rekrutmen/posisi/{id}', [\App\Http\Controllers\AdminRekrutmenController::class , 'posisiUpdate'])->name('admin.rekrutmen.posisi.update');
    Route::patch('/admin/rekrutmen/posisi/{id}/toggle', [\App\Http\Controllers\AdminRekrutmenController::class , 'posisiToggleStatus'])->name('admin.rekrutmen.posisi.toggle');
    Route::delete('/admin/rekrutmen/posisi/{id}', [\App\Http\Controllers\AdminRekrutmenController::class , 'posisiDestroy'])->name('admin.rekrutmen.posisi.destroy');

    Route::get('/admin/rekrutmen/pendaftar', [\App\Http\Controllers\AdminRekrutmenController::class , 'pendaftarIndex'])->name('admin.rekrutmen.pendaftar.index');
    Route::get('/admin/rekrutmen/pendaftar/{id}', [\App\Http\Controllers\AdminRekrutmenController::class , 'pendaftarShow'])->name('admin.rekrutmen.pendaftar.show');
    Route::post('/admin/rekrutmen/pendaftar/{id}/terima', [\App\Http\Controllers\AdminRekrutmenController::class , 'terimaPendaftar'])->name('admin.rekrutmen.pendaftar.terima');

});

require __DIR__ . '/auth.php';
