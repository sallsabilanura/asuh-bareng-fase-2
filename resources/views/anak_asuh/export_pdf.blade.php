<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Anak Asuh - Asuh Bareng</title>
    <style>
        @page {
            margin: 2.5cm 0 1cm 0; /* Reduced margins to save space */
        }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
            color: #333;
        }
        /* Fixed border for every page */
        .page-border {
            position: fixed;
            top: -2.5cm; /* Adjusted for new margin */
            left: 0;
            width: 210mm;
            height: 297mm;
            border: 15px solid #ff4d94;
            box-sizing: border-box;
            z-index: 1000;
            pointer-events: none;
        }
        .header {
            position: fixed;
            top: -1.8cm; /* Adjusted for new margin */
            left: 0;
            right: 0;
            text-align: center;
            z-index: 1001;
        }
        .header h1 {
            color: #ff4d94;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 22px;
            font-weight: 900;
        }
        .content {
            padding: 0 40px;
        }
        .child-card {
            height: 7.8cm; /* Shorter cards to fit 3 per page */
            width: 100%;
            clear: both;
            position: relative;
            box-sizing: border-box;
            padding-top: 10px;
        }
        .photo-box {
            width: 160px;
            background: white;
            padding: 8px;
            border: 1px solid #ddd;
            box-shadow: 8px 8px 15px rgba(0,0,0,0.1);
            text-align: center;
            float: left;
        }
        .photo-box img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            margin-bottom: 8px;
        }
        .photo-box .name {
            font-weight: 900;
            font-size: 13px;
            color: #333;
            text-transform: uppercase;
        }
        .photo-box .age {
            font-size: 12px;
            color: #666;
            font-weight: bold;
        }
        .info-box {
            float: left;
            width: 420px;
            padding: 10px 25px;
        }
        .info-box p {
            line-height: 1.6;
            font-size: 13px;
            margin-bottom: 15px;
            margin-top: 0;
            color: #444;
            text-align: justify;
        }
        
        /* Alternating layouts */
        .card-left .photo-box { float: left; margin-right: 30px; }
        .card-left .info-box { float: left; text-align: left; }
        
        .card-right .photo-box { float: right; margin-left: 30px; }
        .card-right .info-box { float: right; text-align: right; }

        .footer {
            position: fixed;
            bottom: 20px;
            left: 0;
            right: 0;
            text-align: center;
            padding: 10px;
            font-size: 11px;
            font-weight: bold;
            color: #ff4d94;
            z-index: 1001;
        }
        .footer span {
            margin: 0 15px;
        }
        .divider {
            border-top: 1px dashed #ff4d94;
            margin: 10px 0;
            clear: both;
            opacity: 0.3;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <!-- Border fixed on every page -->
    <div class="page-border"></div>

    <div class="header">
        <h1>PROFIL ANAK ASUH</h1>
    </div>

    <div class="content">
        @foreach($anakAsuhs as $index => $anak)
            <div class="child-card {{ $index % 2 == 0 ? 'card-left' : 'card-right' }}">
                <div class="photo-box">
                    @if($anak->FotoAnak && file_exists(public_path('storage/' . $anak->FotoAnak)))
                        <img src="{{ public_path('storage/' . $anak->FotoAnak) }}" alt="{{ $anak->NamaLengkap }}">
                    @else
                        <div style="width: 100%; height: 180px; background: #f9f9f9; display: flex; align-items: center; justify-content: center; color: #ccc; border: 1px dashed #ddd;">
                            <span style="font-size: 40px;">?</span>
                        </div>
                    @endif
                    <div class="name">{{ $anak->NamaLengkap }}</div>
                    <div class="age">{{ $anak->umur }} Tahun</div>
                </div>
                <div class="info-box">
                    <p>
                        <strong>{{ $anak->NamaLengkap }}</strong> lahir pada {{ \Carbon\Carbon::parse($anak->TanggalLahir)->translatedFormat('d F Y') }}{{ $anak->TempatLahir && $anak->TempatLahir != '-' ? ', ' . $anak->TempatLahir : '' }} dan saat ini genap berusia {{ $anak->umur }} tahun. 
                        Merupakan putra/putri dari Bapak/Ibu {{ $anak->NamaOrangTua ?? '---' }}.
                    </p>
                    <p>
                        {{ $anak->NamaLengkap }} saat ini sedang menempuh pendidikan <strong>{{ $anak->Sekolah }}</strong>. 
                        Kesehariannya dihabiskan di lingkungan {{ $anak->Alamat }}. 
                        Status keaktifan saat ini adalah <span style="color: #e91e63; font-weight: bold;">{{ strtoupper($anak->Status) }}</span>.
                        @if($anak->NomorTelp)
                            Kontak: {{ $anak->NomorTelp }}
                        @endif
                    </p>
                </div>
                <div style="clear: both;"></div>
            </div>

            @if(($index + 1) % 3 != 0 && !$loop->last)
                <div class="divider"></div>
            @endif
            
            @if(($index + 1) % 3 == 0 && !$loop->last)
                <div class="page-break"></div>
            @endif
        @endforeach
    </div>

    <div class="footer">
        <span>✉ ashbareng@gmail.com</span>
        <span>📞 +62 851-8027-5942</span>
        <span>🌐 Asuh Bareng</span>
    </div>
</body>
</html>
