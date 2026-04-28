<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Asuh Bareng • Platform Monitoring Anak Asuh</title>
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #ffffff;
            color: #0a0c12;
            line-height: 1.4;
            scroll-behavior: smooth;
        }

        /* modern container */
        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 32px;
        }

        /* navbar fresh */
        .navbar {
            position: sticky;
            top: 0;
            width: 100%;
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(236, 72, 153, 0.12);
            z-index: 100;
            padding: 14px 0;
        }

        .navbar-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-img {
            height: 40px;
            width: auto;
            transition: transform 0.2s ease;
        }

        .logo-text {
            font-size: 1.45rem;
            font-weight: 700;
            background: linear-gradient(135deg, #ec4899 0%, #be185d 100%);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            letter-spacing: -0.3px;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
        }

        .nav-link {
            font-size: 0.9rem;
            font-weight: 500;
            color: #1e293b;
            text-decoration: none;
            transition: 0.2s;
        }

        .nav-link:hover {
            color: #ec4899;
        }

        .auth-buttons {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .btn-login {
            font-size: 0.85rem;
            font-weight: 600;
            color: #334155;
            text-decoration: none;
            padding: 8px 18px;
            border-radius: 40px;
            transition: 0.2s;
        }

        .btn-login:hover {
            background: #f1f5f9;
            color: #ec4899;
        }

        .btn-register, .btn-dashboard {
            font-size: 0.85rem;
            font-weight: 600;
            background: #ec4899;
            color: white;
            padding: 8px 20px;
            border-radius: 40px;
            text-decoration: none;
            transition: all 0.2s ease;
            box-shadow: 0 2px 6px rgba(236,72,153,0.2);
        }

        .btn-register:hover, .btn-dashboard:hover {
            background: #db2777;
            transform: translateY(-1px);
            box-shadow: 0 8px 18px rgba(236,72,153,0.3);
        }

        /* Hero section — modern asymmetric layout */
        .hero {
            padding: 80px 0 72px;
            background: radial-gradient(circle at 80% 20%, rgba(253,242,248,0.6) 0%, #ffffff 70%);
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1fr 0.9fr;
            gap: 48px;
            align-items: center;
        }

        .hero-badge {
            background: rgba(236, 72, 153, 0.1);
            backdrop-filter: blur(2px);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 18px;
            border-radius: 60px;
            font-size: 0.8rem;
            font-weight: 600;
            color: #be185d;
            margin-bottom: 24px;
            border: 1px solid rgba(236,72,153,0.2);
        }

        .hero-title {
            font-size: 3.6rem;
            font-weight: 800;
            line-height: 1.2;
            letter-spacing: -0.02em;
            color: #0f172a;
            margin-bottom: 18px;
        }

        .hero-title-gradient {
            background: linear-gradient(135deg, #ec4899, #f97316);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
        }

        .hero-sub {
            font-size: 1.3rem;
            font-weight: 500;
            color: #475569;
            margin-top: 8px;
        }

        .hero-description {
            font-size: 1.05rem;
            color: #334155;
            max-width: 90%;
            margin: 24px 0 32px;
            line-height: 1.5;
        }

        .hero-stats {
            display: flex;
            gap: 48px;
            margin-top: 40px;
        }

        .stat-item h3 {
            font-size: 2rem;
            font-weight: 800;
            color: #0f172a;
        }
        .stat-item p {
            font-size: 0.85rem;
            font-weight: 500;
            color: #5b6e8c;
        }

        /* CARD modern (seperti level-up style) */
        .floating-card {
            background: white;
            border-radius: 2rem;
            padding: 1.5rem;
            box-shadow: 0 25px 45px -12px rgba(0,0,0,0.12), 0 2px 6px rgba(0,0,0,0.02);
            border: 1px solid rgba(236,72,153,0.15);
            transition: transform 0.2s;
        }

        .feature-grid-card {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .mini-feature {
            background: #fef9fc;
            border-radius: 1.2rem;
            padding: 1rem;
            text-align: center;
            transition: all 0.2s;
        }
        .mini-feature:hover {
            background: white;
            transform: translateY(-4px);
            box-shadow: 0 12px 20px -12px rgba(236,72,153,0.2);
        }
        .icon-circle {
            width: 48px;
            height: 48px;
            background: #fce7f3;
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
        }
        .icon-circle.green {
            background: #e0f2fe;
        }
        .mini-feature h4 {
            font-size: 0.9rem;
            font-weight: 700;
            margin-bottom: 4px;
        }
        .btn-group {
            display: flex;
            gap: 16px;
            margin: 28px 0 0;
        }
        .btn-primary {
            background: #ec4899;
            color: white;
            padding: 12px 28px;
            border-radius: 40px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.25s;
            box-shadow: 0 4px 10px rgba(236,72,153,0.25);
        }
        .btn-primary:hover {
            background: #db2777;
            transform: translateY(-2px);
        }
        .btn-outline {
            border: 1.5px solid #e2e8f0;
            background: transparent;
            color: #1e293b;
            padding: 12px 28px;
            border-radius: 40px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: 0.2s;
        }
        .btn-outline:hover {
            border-color: #ec4899;
            color: #ec4899;
        }

        /* Section titles modern */
        .section-header {
            text-align: center;
            margin-bottom: 48px;
        }
        .section-title {
            font-size: 2.2rem;
            font-weight: 700;
            letter-spacing: -0.02em;
        }
        .section-title span {
            background: linear-gradient(120deg, #ec4899, #f97316);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
        }
        .program-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }
        .program-card-modern {
            background: white;
            border-radius: 1.8rem;
            overflow: hidden;
            transition: all 0.3s;
            border: 1px solid #f1f5f9;
            box-shadow: 0 8px 20px rgba(0,0,0,0.02);
        }
        .program-card-modern:hover {
            transform: translateY(-8px);
            box-shadow: 0 24px 40px -16px rgba(236,72,153,0.2);
            border-color: #ffe4f0;
        }
        .program-img {
            padding: 28px;
            display: flex;
            justify-content: center;
            background: #fef9fc;
        }
        .program-img img {
            width: 160px;
            height: 160px;
            object-fit: contain;
            transition: 0.3s;
        }
        .program-content {
            padding: 20px 24px 28px;
            text-align: center;
        }

        /* fitur grid 4 items */
        .feature-modern {
            display: grid;
            grid-template-columns: repeat(4,1fr);
            gap: 24px;
        }
        .feature-tile {
            background: #ffffff;
            border-radius: 1.5rem;
            padding: 24px 16px;
            text-align: center;
            border: 1px solid #f0f2f5;
            transition: 0.2s;
        }
        .feature-tile:hover {
            background: #fef9fc;
            transform: translateY(-6px);
        }

        /* about dual column */
        .about-wrap {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 48px;
            align-items: center;
        }
        .stats-mini-card {
            background: white;
            border-radius: 2rem;
            padding: 32px;
            border: 1px solid #f1f5f9;
        }

        /* recruiter banner modern */
        .recruit-banner {
            background: linear-gradient(110deg, #0c0a2a 0%, #1f1b3e 100%);
            border-radius: 2rem;
            margin: 40px 32px;
            padding: 40px 48px;
            position: relative;
            overflow: hidden;
        }
        .recruit-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 32px;
        }

        /* Galeri */
        .galeri-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 24px;
            margin-top: 32px;
        }
        .galeri-item {
            border-radius: 1.5rem;
            overflow: hidden;
            aspect-ratio: 4/3;
            background: #f8fafc;
            transition: all 0.3s;
        }
        .galeri-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: 0.4s;
        }
        .galeri-item:hover .galeri-img {
            transform: scale(1.05);
        }


        /* footer */
        .footer-modern {
            background: #0f172a;
            color: #e2e8f0;
            padding: 48px 0 24px;
            border-radius: 2rem 2rem 0 0;
            margin-top: 40px;
        }

        /* Responsive Fixes */
        @media (max-width: 900px) {
            .hero-grid, .about-wrap, .program-grid, .feature-modern {
                grid-template-columns: 1fr;
            }
            .container {
                padding: 0 20px;
            }
            .hero-title {
                font-size: 2.5rem;
            }
            .recruit-banner {
                margin: 32px 16px;
                padding: 32px 24px;
            }
            
            /* Navbar Mobile Fix */
            .nav-links {
                display: none; /* Sembunyikan link teks di mobile agar tidak kepotong */
            }
            .navbar-content {
                gap: 10px;
            }
            .logo-img {
                height: 32px;
            }
            .logo-text {
                font-size: 1.1rem;
            }
            .btn-login {
                padding: 6px 12px;
                font-size: 0.75rem;
            }
            .btn-register, .btn-dashboard {
                padding: 6px 14px;
                font-size: 0.75rem;
            }
        }
    </style>
</head>
<body>

<nav class="navbar">
    <div class="container">
        <div class="navbar-content">
            <div class="logo">
                <img class="logo-img" src="{{ asset('bareng.png') }}" alt="Asuh Bareng">
            </div>
            <div class="nav-links">
                <a href="#beranda" class="nav-link">Beranda</a>
                <a href="#program" class="nav-link">Program</a>
                <a href="#fitur" class="nav-link">Fitur</a>
                <a href="#tentang" class="nav-link">Tentang</a>
            </div>
            <div class="auth-buttons">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-dashboard">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn-login">Masuk</a>
                        <a href="{{ route('register') }}" class="btn-register">Daftar</a>
                    @endauth
                @endif
            </div>
        </div>
    </div>
</nav>

<!-- Hero dengan sentuhan "Level Up Skill" modern & friendly -->
<section id="beranda" class="hero">
    <div class="container">
        <div class="hero-grid">
            <div>
                <div class="hero-badge">
                    <i data-lucide="sparkles" style="width: 16px;"></i> Kolaborasi dengan Zakat Sukses
                </div>
                <h1 class="hero-title">
                    Asuh Bareng <span class="hero-title-gradient">#BaikBareng</span>
                    <div class="hero-sub">Platform Monitoring Anak Asuh</div>
                </h1>
                <p class="hero-description">
                    Bersama <strong>Zakat Sukses</strong>, kami hadir untuk menemani setiap langkah perkembangan anak-anak asuh secara transparan, humanis, dan berdampak.
                </p>
                <div class="btn-group">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-primary">Dashboard <i data-lucide="arrow-right" style="width: 16px;"></i></a>
                    @else
                        <a href="{{ route('register') }}" class="btn-primary">Mulai Sekarang <i data-lucide="heart" style="width: 16px;"></i></a>
                    @endauth
                    <a href="#program" class="btn-outline">Lihat Program <i data-lucide="chevron-down" style="width: 16px;"></i></a>
                </div>
                <div class="hero-stats">
                    <div class="stat-item"><h3>500+</h3><p>Anak Asuh</p></div>
                    <div class="stat-item"><h3>50+</h3><p>Kakak Asuh</p></div>
                    <div class="stat-item"><h3>100%</h3><p>Transparan</p></div>
                </div>
            </div>
            <div>
                <div class="floating-card">
                    <div class="feature-grid-card">
                        <div class="mini-feature"><div class="icon-circle"><i data-lucide="calendar-check" style="width: 24px; color:#ec4899;"></i></div><h4>Absensi</h4><p style="font-size:12px;">Pendampingan rutin</p></div>
                        <div class="mini-feature"><div class="icon-circle green"><i data-lucide="heart-pulse" style="width: 24px; color:#10b981;"></i></div><h4>Kesehatan</h4><p style="font-size:12px;">Pemantauan berkala</p></div>
                        <div class="mini-feature"><div class="icon-circle"><i data-lucide="file-text" style="width: 24px; color:#ec4899;"></i></div><h4>Laporan PDF</h4><p style="font-size:12px;">Data lengkap</p></div>
                        <div class="mini-feature"><div class="icon-circle green"><i data-lucide="users" style="width: 24px; color:#10b981;"></i></div><h4>Komunitas</h4><p style="font-size:12px;">Kolaborasi</p></div>
                    </div>
                    <div style="margin-top: 20px; background:#f8fafc; border-radius: 28px; padding: 12px; text-align: center;">
                        <span style="font-size:13px; font-weight:500;">✨ Pantau perkembangan secara realtime ✨</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- RECRUITMENT BANNER MODERN (if active) -->
@php
    $rekrutmenSetting = \App\Models\SettingRekrutmen::first();
    $hasActivePosisi = \App\Models\PosisiRekrutmen::where('IsActive', true)->exists();
@endphp
@if($rekrutmenSetting && $rekrutmenSetting->IsActive && $hasActivePosisi)
<section>
    <div class="container">
        <div class="recruit-banner">
            <div class="recruit-flex">
                <div>
                    <span style="background:rgba(236,72,153,0.2); padding:4px 12px; border-radius:40px; font-size:12px; font-weight:600; color:#f472b6;">🔥 OPEN RECRUITMENT</span>
                    <h2 style="color:white; font-size:1.8rem; margin-top:12px;">Waktunya Level Up Karirmu!</h2>
                    <p style="color:#cbd5e1; max-width:450px; margin-top:8px;">Bergabung sebagai tim Asuh Bareng & Zakat Sukses. Bangun portofolio nyata dan dampak sosial.</p>
                    <div style="display: flex; gap: 16px; margin-top: 20px;">
                        <a href="{{ route('rekrutmen.panduan') }}" style="background:#ec4899; padding:10px 28px; border-radius:40px; color:white; font-weight:600; text-decoration:none;">Lihat Posisi →</a>
                    </div>
                </div>
                <div style="background: rgba(255,255,255,0.05); border-radius: 32px; padding: 20px 30px; text-align:center;">
                    <i data-lucide="briefcase" style="width: 42px; color:#ec4899;"></i>
                    <p style="color:#cbd5e6; font-weight:500; margin-top:8px;">Berkembang bersama mentor praktisi</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- PROGRAM SECTION dengan gaya modern mirip referensi "Level Up Skill" -->
<section id="program" style="padding: 64px 0; background:#fefcfd;">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Program <span>Unggulan</span></h2>
            <p style="color:#4b5563; max-width:560px; margin:12px auto 0;">Tiga pilar pendampingan untuk anak asuh yang lebih berdaya</p>
        </div>
        <div class="program-grid">
            <div class="program-card-modern">
                <div class="program-img"><img src="{{ asset('bareng.png') }}" alt="Pendampingan Rutin"></div>
                <div class="program-content"><h3 style="font-weight:700;">Pendampingan Rutin</h3><p style="font-size:14px; color:#475569;">Kakak asuh mendampingi belajar & pengembangan diri setiap minggu.</p></div>
            </div>
            <div class="program-card-modern">
                <div class="program-img"><img src="{{ asset('kesehaan.jpg') }}" alt="Monitoring Kesehatan"></div>
                <div class="program-content"><h3 style="font-weight:700;">Monitoring Kesehatan</h3><p style="font-size:14px; color:#475569;">Pemeriksaan berkala fisik & mental, grafik perkembangan.</p></div>
            </div>
            <div class="program-card-modern">
                <div class="program-img"><img src="{{ asset('berkembang.jpg') }}" alt="Laporan Perkembangan"></div>
                <div class="program-content"><h3 style="font-weight:700;">Laporan Perkembangan</h3><p style="font-size:14px; color:#475569;">Laporan transparan & realtime untuk donatur dan keluarga asuh.</p></div>
            </div>
        </div>
    </div>
</section>

<!-- FITUR UNGGULAN (seperti grid modern) -->
<section id="fitur" style="padding: 60px 0;">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Fitur <span>Kekinian</span></h2>
            <p>Semua dalam satu dashboard yang mudah dan humanis</p>
        </div>
        <div class="feature-modern">
            <div class="feature-tile"><i data-lucide="calendar-check" style="width: 36px; color:#ec4899;"></i><h3 style="margin:12px 0 4px;">Absensi Digital</h3><p style="font-size:13px;">Catat kehadiran kakak asuh & anak asuh</p></div>
            <div class="feature-tile"><i data-lucide="activity" style="width: 36px; color:#10b981;"></i><h3 style="margin:12px 0 4px;">Cek Kesehatan</h3><p style="font-size:13px;">Riwayat imunisasi & tinggi badan</p></div>
            <div class="feature-tile"><i data-lucide="file-pie-chart" style="width: 36px; color:#ec4899;"></i><h3 style="margin:12px 0 4px;">Laporan PDF</h3><p style="font-size:13px;">Unduh laporan bulanan instan</p></div>
            <div class="feature-tile"><i data-lucide="trending-up" style="width: 36px; color:#10b981;"></i><h3 style="margin:12px 0 4px;">Grafik Perkembangan</h3><p style="font-size:13px;">Visualisasi capaian anak asuh</p></div>
        </div>
    </div>
</section>

<!-- GALERI DARI ABSENSI PENDAMPINGAN -->
@php
    $galeriPhotos = \App\Models\AbsensiPendampingan::whereNotNull('FotoBukti')
                        ->where('FotoBukti', '!=', '')
                        ->latest('Tanggal')
                        ->take(6)
                        ->get();
@endphp
@if($galeriPhotos->isNotEmpty())
<section style="padding: 20px 0 60px;">
    <div class="container">
        <div class="section-header"><h2 class="section-title">Galeri <span>Kegiatan</span></h2><p>Momen kebersamaan anak asuh & kakak asuh</p></div>
        <div class="galeri-grid">
            @foreach($galeriPhotos as $photo)
            <div x-data="{ openModal: false }" class="galeri-item" style="cursor: pointer;" @click="openModal = true">
                <img class="galeri-img" src="{{ Storage::url($photo->FotoBukti) }}" alt="Kegiatan asuh">
                @if($photo->DeskripsiPerkembangan)<div style="padding:8px 12px; background:white;"><p style="font-size:12px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $photo->DeskripsiPerkembangan }}</p></div>@endif
                
                <!-- Modal -->
                <div x-show="openModal" class="fixed inset-0 z-[100] flex items-center justify-center bg-black/80 p-4 cursor-default" style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; z-index: 9999; background: rgba(0,0,0,0.85); align-items: center; justify-content: center; padding: 20px;" @click.stop>
                    <div @click.outside="openModal = false" style="position: relative; max-width: 900px; width: 100%; display: flex; justify-content: center;">
                        <button @click="openModal = false" style="position: absolute; top: -40px; right: 0; color: rgba(255,255,255,0.7); background: none; border: none; cursor: pointer; padding: 5px;">
                            <svg style="width: 32px; height: 32px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                        <img src="{{ Storage::url($photo->FotoBukti) }}" style="max-height: 85vh; width: auto; max-width: 100%; border-radius: 8px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); background: white;">
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- TENTANG KAMI + STATS -->
<section id="tentang" style="padding: 48px 0 80px; background:#fefafc;">
    <div class="container">
        <div class="about-wrap">
            <div>
                <span style="background:#fce7f3; padding:4px 14px; border-radius:40px; font-size:12px; font-weight:600;">Tentang Kami</span>
                <h2 style="font-size:2rem; margin: 16px 0 12px;">Kolaborasi <span style="color:#ec4899;">Berkah</span> untuk Anak Negeri</h2>
                <p style="color:#334155; line-height:1.5;">Asuh Bareng hadir sebagai jembatan kebaikan antara kakak asuh dan anak asuh dengan sistem monitoring yang modern, terbuka, dan memberdayakan. Terintegrasi penuh dengan Zakat Sukses.</p>
                <ul style="margin-top: 24px; list-style:none;">
                    <li style="display:flex; gap:8px; margin-bottom:12px;"><i data-lucide="check-circle" style="color:#ec4899;"></i> Terintegrasi realtime dengan Zakat Sukses</li>
                    <li style="display:flex; gap:8px; margin-bottom:12px;"><i data-lucide="check-circle" style="color:#10b981;"></i> 100% transparansi donasi & perkembangan</li>
                    <li style="display:flex; gap:8px;"><i data-lucide="check-circle" style="color:#ec4899;"></i> Didukung mentor praktisi & komunitas peduli</li>
                </ul>
            </div>
            <div class="stats-mini-card">
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:24px;">
                    <div><h3 style="font-size:2rem; color:#ec4899;">2018</h3><p>Tahun Berdiri</p></div>
                    <div><h3 style="font-size:2rem; color:#10b981;">7+</h3><p>Kota Aktif</p></div>
                    <div><h3 style="font-size:2rem; color:#ec4899;">500+</h3><p>Anak Asuh</p></div>
                    <div><h3 style="font-size:2rem; color:#10b981;">50+</h3><p>Kakak Asuh</p></div>
                </div>
                <div style="margin-top: 28px; background:#fdf2f8; border-radius: 1rem; padding: 12px; text-align:center;">
                    <span style="font-weight:600;">⭐ #AsuhBarengBerbagiBerkah ⭐</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- TESTIMONIAL -->
<section style="padding: 40px 0 60px;">
    <div class="container">
        <div class="section-header"><h2 class="section-title">Kata <span>Mereka</span></h2><p>Dari kakak asuh & mitra yang sudah bergabung</p></div>
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(280px,1fr)); gap:24px;">
            <div style="background:#fff; border-radius:1.5rem; padding:1.5rem; border:1px solid #f0e9f0;"><div style="display:flex; gap:12px; align-items:center;"><div style="background:#ec4899; width:42px; height:42px; border-radius:60px; display:flex; align-items:center; justify-content:center; color:white;">AF</div><div><b>Ahmad Fauzi</b><p style="font-size:12px;">Kakak Asuh</p></div></div><p style="margin-top:12px;">“Platform super membantu, progres anak asuh jadi terukur dan terasa kekeluargaan.”</p></div>
            <div style="background:#fff; border-radius:1.5rem; padding:1.5rem; border:1px solid #f0e9f0;"><div style="display:flex; gap:12px; align-items:center;"><div style="background:#10b981; width:42px; height:42px; border-radius:60px; display:flex; align-items:center; justify-content:center; color:white;">SN</div><div><b>Siti Nurhaliza</b><p style="font-size:12px;">Relawan</p></div></div><p style="margin-top:12px;">“Aplikasi intuitif, laporan perkembangan anak asuh bisa langsung dilihat donatur.”</p></div>
            <div style="background:#fff; border-radius:1.5rem; padding:1.5rem; border:1px solid #f0e9f0;"><div style="display:flex; gap:12px; align-items:center;"><div style="background:#ec4899; width:42px; height:42px; border-radius:60px; display:flex; align-items:center; justify-content:center; color:white;">ZS</div><div><b>Zakat Sukses</b><p style="font-size:12px;">Mitra</p></div></div><p style="margin-top:12px;">“Kolaborasi yang efektif, monitoring menjadi lebih transparan dan berdampak luas.”</p></div>
        </div>
    </div>
</section>

<!-- CTA Level Up Style -->
<section style="background: linear-gradient(120deg, #fdf2f8, #fff0f5); padding: 56px 0; border-radius: 2rem 2rem 0 0; margin-top: 20px;">
    <div class="container" style="text-align: center;">
        <h2 style="font-size: 2rem; font-weight:800;">Siap Menjadi Bagian dari Gerakan Kebaikan?</h2>
        <p style="color:#334155; max-width: 520px; margin: 12px auto 28px;">Waktunya level up dampak sosialmu. Mulai dari menjadi kakak asuh atau donatur terpercaya.</p>
        <div style="display:flex; gap:16px; justify-content: center;">
            @auth <a href="{{ url('/dashboard') }}" class="btn-primary">Dashboard <i data-lucide="layout-dashboard"></i></a> @else <a href="{{ route('register') }}" class="btn-primary">Daftar Kakak Asuh <i data-lucide="users"></i></a> @endauth
            <a href="#program" class="btn-outline">Lihat Program</a>
        </div>
    </div>
</section>

<!-- FOOTER MODERN -->
<footer class="footer-modern">
    <div class="container">
        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(200px,1fr)); gap: 36px;">
            <div><img src="{{ asset('bareng.png') }}" style="height: 40px; margin-bottom: 10px;"><p style="color:#94a3b8;">Platform monitoring anak asuh yang hangat & transparan. #AsuhBareng</p></div>
            <div><h4 style="color:white;">Jelajahi</h4><ul style="list-style:none; margin-top:12px;"><li><a href="#beranda" style="color:#cbd5e1; text-decoration:none;">Beranda</a></li><li><a href="#program" style="color:#cbd5e1; text-decoration:none;">Program</a></li><li><a href="#fitur" style="color:#cbd5e1; text-decoration:none;">Fitur</a></li></ul></div>
            <div><h4 style="color:white;">Kolaborasi</h4><div style="display:flex; align-items:center; gap:8px; margin-top:12px;"><img src="{{ asset('zakatsukses.png') }}" style="height:28px;"><span style="color:#22c55e;">Zakat Sukses</span></div></div>
        </div>
        <hr style="border-color:#334155; margin: 32px 0 20px;">
        <div style="display:flex; justify-content: space-between; font-size:12px; color:#64748b;"><span>© {{ date('Y') }} Asuh Bareng — Menebar manfaat untuk anak asuh Indonesia</span><span>v1.0</span></div>
    </div>
</footer>

<script>
    lucide.createIcons();
</script>
</body>
</html>