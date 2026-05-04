<?php

namespace App\Imports;

use App\Models\CekKesehatan;
use App\Models\AnakAsuh;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class CekKesehatanImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Try to find AnakAsuhID from name if ID is not explicitly provided or is invalid
        $anakAsuhId = null;
        
        // Flexible key search
        $namaKey = $this->findKey($row, ['nama', 'anak', 'anak_asuh', 'nama_lengkap']);
        if ($namaKey && !empty($row[$namaKey])) {
            $anak = AnakAsuh::where('NamaLengkap', 'like', '%' . $row[$namaKey] . '%')->first();
            if ($anak) {
                $anakAsuhId = $anak->id;
            }
        }

        // If still null, try ID key
        if (!$anakAsuhId) {
            $idKey = $this->findKey($row, ['id', 'anak_id', 'anak_asuh_id']);
            $anakAsuhId = $row[$idKey] ?? null;
        }

        if (!$anakAsuhId) {
            return null; // Skip if no child found
        }

        return new CekKesehatan([
            'AnakAsuhID'         => $anakAsuhId,
            'TanggalPemeriksaan' => $row[$this->findKey($row, ['tanggal', 'pemeriksaan', 'tgl'])] ?? date('Y-m-d'),
            'BeratBadan'         => $row[$this->findKey($row, ['berat', 'bb', 'berat_badan'])] ?? 0,
            'TinggiBadan'        => $row[$this->findKey($row, ['tinggi', 'tb', 'tinggi_badan'])] ?? 0,
            'LingkarKepala'      => $row[$this->findKey($row, ['lingkar', 'lk', 'lingkar_kepala'])] ?? 0,
            'IMT'                => $row[$this->findKey($row, ['imt', 'bmi'])] ?? 0,
            'StatusGizi'         => $row[$this->findKey($row, ['status_gizi', 'gizi'])] ?? 'Normal',
            'KesehatanMata'      => $row[$this->findKey($row, ['mata', 'kesehatan_mata'])] ?? 'Sehat',
            'KesehatanGigi'      => $row[$this->findKey($row, ['gigi', 'kesehatan_gigi'])] ?? 'Sehat',
            'Pendengaran'        => $row[$this->findKey($row, ['pendengaran', 'telinga'])] ?? 'Normal',
            'RiwayatPenyakit'    => $row[$this->findKey($row, ['penyakit', 'riwayat_penyakit'])] ?? '-',
            'MotorikKasar'       => $row[$this->findKey($row, ['motorik_kasar', 'kasar'])] ?? 'Baik',
            'MotorikHalus'       => $row[$this->findKey($row, ['motorik_halus', 'halus'])] ?? 'Baik',
            'ResponsSensorik'    => $row[$this->findKey($row, ['sensorik', 'respons_sensorik'])] ?? 'Baik',
            'InteraksiSosial'    => $row[$this->findKey($row, ['sosial', 'interaksi'])] ?? 'Baik',
            'FokusKonsentrasi'   => $row[$this->findKey($row, ['fokus', 'konsentrasi'])] ?? 'Baik',
            'EkspresiEmosi'      => $row[$this->findKey($row, ['emosi', 'ekspresi'])] ?? 'Stabil',
            'FrekuensiMakan'     => $row[$this->findKey($row, ['frekuensi_makan', 'makan'])] ?? '3x sehari',
            'JenisMakanan'       => $row[$this->findKey($row, ['jenis_makanan', 'menu'])] ?? 'Sehat',
            'PolaTidur'          => $row[$this->findKey($row, ['pola_tidur', 'tidur'])] ?? 'Teratur',
            'WaktuTidur'         => $row[$this->findKey($row, ['waktu_tidur'])] ?? '20:00',
            'WaktuBangun'        => $row[$this->findKey($row, ['waktu_bangun'])] ?? '05:00',
            'KebiasaanTidur'     => $row[$this->findKey($row, ['kebiasaan_tidur'])] ?? '-',
            'CatatanPemeriksaan' => $row[$this->findKey($row, ['catatan', 'keterangan'])] ?? '-',
        ]);
    }

    /**
     * Helper to find a key in the row array that matches one of the needles (partial/case-insensitive)
     */
    private function findKey($row, $needles)
    {
        $keys = array_keys($row);
        foreach ($needles as $needle) {
            foreach ($keys as $key) {
                // Normalize key: remove spaces, underscores, and lowercase
                $normalizedKey = strtolower(str_replace([' ', '_', '-'], '', $key));
                $normalizedNeedle = strtolower(str_replace([' ', '_', '-'], '', $needle));
                
                if ($normalizedKey === $normalizedNeedle || Str::contains($normalizedKey, $normalizedNeedle)) {
                    return $key;
                }
            }
        }
        return null;
    }
}
