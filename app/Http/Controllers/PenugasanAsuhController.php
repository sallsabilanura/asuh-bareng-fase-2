<?php

namespace App\Http\Controllers;

use App\Models\PenugasanAsuh;
use App\Models\AnakAsuh;
use App\Models\KakakAsuh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PenugasanAsuhMail;

class PenugasanAsuhController extends Controller
{
    public function index(Request $request)
    {
        $query = PenugasanAsuh::with(['anakAsuh', 'kakakAsuh'])->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('kakakAsuh', function ($q) use ($search) {
                $q->where('NamaLengkap', 'like', '%' . $search . '%');
            })->orWhereHas('anakAsuh', function ($q) use ($search) {
                $q->where('NamaLengkap', 'like', '%' . $search . '%');
            });
        }

        // Grouping by KakakAsuhID to show grouped children per caretaker
        $penugasans = $query->get()->groupBy('KakakAsuhID');

        return view('penugasan_asuh.index', compact('penugasans'));
    }

    public function create()
    {
        // Only children who are NOT yet assigned
        $anakAsuhs = AnakAsuh::doesntHave('penugasan')->get();
        $kakakAsuhs = KakakAsuh::all();
        return view('penugasan_asuh.create', compact('anakAsuhs', 'kakakAsuhs'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'AnakAsuhIDs' => 'required|array',
            'AnakAsuhIDs.*' => 'required|exists:anak_asuhs,id',
            'KakakAsuhID' => 'required|exists:kakak_asuhs,KakakAsuhID',
            'TanggalMulai' => 'required|date',
            'TanggalSelesai' => 'nullable|date|after_or_equal:TanggalMulai',
        ]);

        $kakakAsuh = KakakAsuh::with('user')->findOrFail($validatedData['KakakAsuhID']);
        $anakAsuhNames = [];

        foreach ($validatedData['AnakAsuhIDs'] as $anakAsuhID) {
            $anak = AnakAsuh::find($anakAsuhID);
            if ($anak) {
                $anakAsuhNames[] = $anak->NamaLengkap;
            }
            
            PenugasanAsuh::create([
                'AnakAsuhID' => $anakAsuhID,
                'KakakAsuhID' => $validatedData['KakakAsuhID'],
                'TanggalMulai' => $validatedData['TanggalMulai'],
                'TanggalSelesai' => $validatedData['TanggalSelesai'],
            ]);
        }

        if (!empty($anakAsuhNames)) {
            $email = $kakakAsuh->Email ?? ($kakakAsuh->user ? $kakakAsuh->user->email : null);
            if ($email) {
                try {
                    Mail::to($email)->send(new PenugasanAsuhMail($kakakAsuh, $anakAsuhNames));
                } catch (\Exception $e) {
                    // Log error if mail fails but don't stop the process
                    \Illuminate\Support\Facades\Log::error('Failed to send PenugasanAsuh email: ' . $e->getMessage());
                }
            }
        }

        return redirect()->route('penugasan_asuh.index')->with('success', 'Penugasan berhasil dibuat.');
    }

    public function edit($id)
    {
        $penugasan = PenugasanAsuh::findOrFail($id);
        $anakAsuhs = AnakAsuh::all();
        $kakakAsuhs = KakakAsuh::all();
        return view('penugasan_asuh.edit', compact('penugasan', 'anakAsuhs', 'kakakAsuhs'));
    }

    public function update(Request $request, $id)
    {
        $penugasan = PenugasanAsuh::findOrFail($id);

        $validatedData = $request->validate([
            'AnakAsuhID' => 'required|exists:anak_asuhs,id',
            'KakakAsuhID' => 'required|exists:kakak_asuhs,KakakAsuhID',
            'TanggalMulai' => 'required|date',
            'TanggalSelesai' => 'nullable|date|after_or_equal:TanggalMulai',
        ]);

        $penugasan->update($validatedData);

        return redirect()->route('penugasan_asuh.index')->with('success', 'Penugasan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $penugasan = PenugasanAsuh::findOrFail($id);
        $penugasan->delete();

        return redirect()->route('penugasan_asuh.index')->with('success', 'Penugasan berhasil dihapus.');
    }
}
