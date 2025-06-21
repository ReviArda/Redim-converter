@extends('layouts.app')

@section('title', 'Redim Converter - Kompresi & Konversi File Online')
@section('description', 'Kompresi dan konversi file online gratis. Konversi Word ke PDF, kompres gambar, kompres PDF, dan banyak lagi.')

@section('content')
    <!-- Hero Section -->
    <div class="hero-section text-center" data-aos="fade-in">
        <h1 class="display-3 fw-bolder mb-3 gradient-text">
            Kompresi & Konversi File Online
        </h1>
        <p class="lead text-muted mb-4 mx-auto" style="max-width: 600px;">
            Platform gratis untuk kompresi dan konversi berbagai jenis file dengan mudah dan cepat.
        </p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <span class="value-prop"><i class="fas fa-check-circle"></i> Aman & Privat</span>
            <span class="value-prop"><i class="fas fa-check-circle"></i> Cepat & Mudah</span>
            <span class="value-prop"><i class="fas fa-check-circle"></i> 100% Gratis</span>
            <span class="value-prop"><i class="fas fa-check-circle"></i> Tanpa Registrasi</span>
        </div>
    </div>

    <!-- Features Grid -->
    <div class="row g-4 justify-content-center mt-5">
        <!-- Kompres Gambar -->
        <div class="col-lg-5 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="feature-card h-100 d-flex flex-column">
                <div class="feature-icon">
                    <i class="fas fa-image"></i>
                </div>
                <h4 class="fw-bold mb-3">Kompres Gambar</h4>
                <p class="text-muted mb-4">
                    Perkecil ukuran file gambar JPG, PNG tanpa mengurangi kualitas yang signifikan
                </p>
                <div class="mt-auto">
                    <a href="{{ route('compress-image') }}" class="btn btn-primary w-100">
                        <i class="fas fa-arrow-right me-2"></i>
                        Mulai Kompres
                    </a>
                </div>
            </div>
        </div>

        <!-- Kompres PDF -->
        <div class="col-lg-5 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="feature-card h-100 d-flex flex-column">
                <div class="feature-icon">
                    <i class="fas fa-file-pdf"></i>
                </div>
                <h4 class="fw-bold mb-3">Kompres PDF</h4>
                <p class="text-muted mb-4">
                    Perkecil ukuran file PDF dengan tetap mempertahankan kualitas dokumen
                </p>
                <div class="mt-auto">
                    <a href="{{ route('compress-pdf') }}" class="btn btn-primary w-100">
                        <i class="fas fa-arrow-right me-2"></i>
                        Mulai Kompres
                    </a>
                </div>
            </div>
        </div>

        <!-- Word to PDF -->
        <div class="col-lg-5 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="feature-card h-100 d-flex flex-column">
                <div class="feature-icon">
                    <i class="fas fa-file-word"></i>
                </div>
                <h4 class="fw-bold mb-3">Word ke PDF</h4>
                <p class="text-muted mb-4">
                    Konversi dokumen Word (.doc, .docx) ke format PDF dengan mudah
                </p>
                <div class="mt-auto">
                    <a href="{{ route('word-to-pdf') }}" class="btn btn-primary w-100">
                        <i class="fas fa-arrow-right me-2"></i>
                        Mulai Konversi
                    </a>
                </div>
            </div>
        </div>

        <!-- Image to PDF -->
        <div class="col-lg-5 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="feature-card h-100 d-flex flex-column">
                <div class="feature-icon">
                    <i class="fas fa-images"></i>
                </div>
                <h4 class="fw-bold mb-3">Gambar ke PDF</h4>
                <p class="text-muted mb-4">
                    Gabungkan beberapa gambar menjadi satu file PDF yang rapi
                </p>
                <div class="mt-auto">
                    <a href="{{ route('image-to-pdf') }}" class="btn btn-primary w-100">
                        <i class="fas fa-arrow-right me-2"></i>
                        Mulai Konversi
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="row mt-5 pt-5" data-aos="fade-up">
        <div class="col-12">
            <h2 class="text-center fw-bold mb-5">Mengapa Memilih Redim Converter?</h2>
        </div>
        <div class="col-md-4 text-center mb-4">
            <div class="feature-icon mx-auto mb-3" style="width: 60px; height: 60px; font-size: 1.5rem;">
                <i class="fas fa-shield-alt"></i>
            </div>
            <h5 class="fw-bold">100% Aman</h5>
            <p class="text-muted">File Anda dihapus secara otomatis setelah 24 jam. Tidak ada yang dapat mengakses file Anda.</p>
        </div>
        <div class="col-md-4 text-center mb-4">
            <div class="feature-icon mx-auto mb-3" style="width: 60px; height: 60px; font-size: 1.5rem;">
                <i class="fas fa-bolt"></i>
            </div>
            <h5 class="fw-bold">Cepat & Efisien</h5>
            <p class="text-muted">Proses konversi dan kompresi yang cepat dengan teknologi terbaru.</p>
        </div>
        <div class="col-md-4 text-center mb-4">
            <div class="feature-icon mx-auto mb-3" style="width: 60px; height: 60px; font-size: 1.5rem;">
                <i class="fas fa-mobile-alt"></i>
            </div>
            <h5 class="fw-bold">Responsive</h5>
            <p class="text-muted">Dapat diakses dari berbagai perangkat, desktop, tablet, maupun mobile.</p>
        </div>
    </div>
@endsection 