<!DOCTYPE html>
<html>
<head>
    <title>Pemberitahuan Penugasan Asuh Baru</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.6;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        h2 {
            color: #d81b60; /* Pink-ish color */
        }
        ul {
            background: #fff;
            padding: 15px 30px;
            border-radius: 5px;
            border: 1px solid #eee;
        }
        li {
            margin-bottom: 5px;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #777;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Halo Kak {{ $kakakAsuh->NamaLengkap }},</h2>
        <p>Anda telah diberikan penugasan baru oleh Admin untuk mendampingi anak asuh. Berikut adalah daftar anak asuh yang baru saja ditugaskan kepada Anda:</p>
        
        <ul>
            @foreach($anakAsuhNames as $namaAnak)
                <li><strong>{{ $namaAnak }}</strong></li>
            @endforeach
        </ul>

        <p>Silakan periksa dashboard aplikasi untuk melihat detail rencana program dan absensi pendampingan.</p>

        <p>Terima kasih atas dedikasi dan perhatian Anda.<br>
        <strong>Tim AsuhBareng</strong></p>

        <div class="footer">
            Email ini dihasilkan secara otomatis oleh sistem, mohon untuk tidak membalas email ini.
        </div>
    </div>
</body>
</html>
