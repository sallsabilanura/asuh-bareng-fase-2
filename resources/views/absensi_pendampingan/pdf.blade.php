<!DOCTYPE html>
<html>
<head>
    <title>Rekapitulasi Kafalah Kakak Asuh</title>
    <style>
        @page {
            margin: 1cm;
        }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #333;
            line-height: 1.4;
            margin: 0;
            padding: 0;
        }
        .header {
            border-bottom: 3px solid #d53f8c;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .logo-section {
            float: left;
            width: 50%;
        }
        .report-info {
            float: right;
            width: 50%;
            text-align: right;
            font-size: 11px;
            color: #666;
        }
        .clear {
            clear: both;
        }
        h1 {
            color: #d53f8c;
            font-size: 24px;
            margin: 10px 0 5px 0;
            text-transform: uppercase;
        }
        h2 {
            color: #2d3748;
            font-size: 18px;
            margin: 0;
        }
        .mentor-section {
            margin-top: 30px;
            page-break-inside: avoid;
        }
        .mentor-header {
            background-color: #f7fafc;
            border-left: 5px solid #d53f8c;
            padding: 10px 15px;
            margin-bottom: 10px;
        }
        .mentor-name {
            font-size: 16px;
            font-weight: bold;
            color: #2d3748;
            margin: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            font-size: 11px;
        }
        th {
            background-color: #edf2f7;
            color: #4a5568;
            font-weight: bold;
            text-transform: uppercase;
            padding: 10px 8px;
            border: 1px solid #e2e8f0;
            text-align: left;
        }
        td {
            padding: 8px;
            border: 1px solid #e2e8f0;
            vertical-align: top;
        }
        tr:nth-child(even) {
            background-color: #fcfcfc;
        }
        .subtotal-row {
            background-color: #fff5f7 !important;
            font-weight: bold;
        }
        .amount {
            text-align: right;
            white-space: nowrap;
        }
        .grand-total {
            margin-top: 40px;
            padding: 20px;
            background-color: #f0fff4;
            border: 2px solid #38a169;
            border-radius: 10px;
            text-align: right;
        }
        .grand-total h3 {
            margin: 0;
            color: #2f855a;
            font-size: 20px;
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 10px;
            color: #a0aec0;
            padding: 10px 0;
            border-top: 1px solid #e2e8f0;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo-section">
            <h1>AsuhBareng</h1>
            @if(Auth::user()->role === 'admin')
            <h2>Laporan Rekapitulasi Kafalah</h2>
            @else
            <h2>Laporan Absensi Pendampingan</h2>
            @endif
        </div>
        <div class="report-info">
            <p>Dicetak pada: {{ date('d F Y, H:i') }}</p>
            <p>Status: Laporan Internal</p>
        </div>
        <div class="clear"></div>
    </div>

    @php
        $groupedAbsensis = $absensis->groupBy('KakakAsuhID');
        $grandTotalKafalah = 0;
    @endphp

    @foreach($groupedAbsensis as $kakakAsuhId => $items)
        @php
            $mentor = $items->first()->kakakAsuh;
            $subtotalKafalah = $items->sum('kafalah');
            $grandTotalKafalah += $subtotalKafalah;
        @endphp

        <div class="mentor-section">
            <div class="mentor-header">
                <p class="mentor-name">Kakak Asuh: {{ $mentor->NamaLengkap ?? 'N/A' }}</p>
            </div>

            <table>
                <thead>
                    <tr>
                        <th style="width: 25px;">No</th>
                        <th>Anak Asuh</th>
                        <th>Jenis</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th style="width: 40px;">Nilai</th>
                        @if(Auth::user()->role === 'admin')
                        <th class="amount">Kafalah</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $index => $absensi)
                    <tr>
                        <td style="text-align: center;">{{ $index + 1 }}</td>
                        <td><strong>{{ $absensi->anakAsuh->NamaLengkap ?? 'N/A' }}</strong></td>
                        <td>{{ $absensi->JenisPendampingan }}</td>
                        <td>{{ \Carbon\Carbon::parse($absensi->Tanggal)->translatedFormat('d M Y') }}</td>
                        <td>{{ substr($absensi->WaktuMulai, 0, 5) }} - {{ substr($absensi->WaktuSelesai, 0, 5) }}</td>
                        <td style="text-align: center;">{{ $absensi->NilaiPendampingan ?? '-' }} ({{ $absensi->NilaiHuruf ?? '-' }})</td>
                        @if(Auth::user()->role === 'admin')
                        <td class="amount">Rp{{ number_format($absensi->kafalah, 0, ',', '.') }}</td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
                @if(Auth::user()->role === 'admin')
                <tfoot>
                    <tr class="subtotal-row">
                        <td colspan="6" style="text-align: right;">SUBTOTAL KAFALAH:</td>
                        <td class="amount" style="color: #c53030;">Rp{{ number_format($subtotalKafalah, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>
    @endforeach

    @if(Auth::user()->role === 'admin')
    <div class="grand-total">
        <p style="margin: 0; font-size: 12px; color: #48bb78; font-weight: bold; text-transform: uppercase;">Total Keseluruhan Dana Kafalah</p>
        <h3>Rp{{ number_format($grandTotalKafalah, 0, ',', '.') }}</h3>
    </div>
    @endif

    <div class="footer">
        Laporan ini dihasilkan secara otomatis oleh Sistem Manajemen AsuhBareng &copy; {{ date('Y') }}
    </div>
</body>
</html>
