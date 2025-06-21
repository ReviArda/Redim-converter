@extends('layouts.app')

@section('title', 'Tentang Kami - Redim Converter')
@section('description', 'Pelajari lebih lanjut tentang Redim Converter, misi kami, teknologi yang kami gunakan, dan tim di balik layar.')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <div class="text-center mb-5" data-aos="fade-in">
                <h1 class="display-5 fw-bold">Tentang Redim Converter</h1>
                <p class="lead text-muted">Solusi andal Anda untuk semua kebutuhan konversi dan kompresi file.</p>
            </div>

            <!-- Misi Kami Section -->
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="fw-bold mb-4">Misi Kami</h2>
                <div class="row g-4 justify-content-center">
                    <!-- Pillar 1: Mudah & Cepat -->
                    <div class="col-md-4">
                        <div class="feature-card h-100">
                            <div class="feature-icon mb-4">
                                <i class="fas fa-rocket"></i>
                            </div>
                            <h5 class="fw-bold">Mudah & Cepat</h5>
                            <p class="text-muted small">Menyediakan antarmuka yang intuitif agar dapat digunakan oleh siapa saja dengan proses yang sangat cepat.</p>
                        </div>
                    </div>
                    <!-- Pillar 2: Aman & Privat -->
                    <div class="col-md-4">
                        <div class="feature-card h-100">
                            <div class="feature-icon mb-4">
                                <i class="fas fa-user-shield"></i>
                            </div>
                            <h5 class="fw-bold">Aman & Privat</h5>
                            <p class="text-muted small">Menjamin keamanan file Anda dengan enkripsi dan menghapusnya secara otomatis setelah 24 jam.</p>
                        </div>
                    </div>
                    <!-- Pillar 3: Gratis & Aksesibel -->
                    <div class="col-md-4">
                        <div class="feature-card h-100">
                            <div class="feature-icon mb-4">
                                <i class="fas fa-gift"></i>
                            </div>
                            <h5 class="fw-bold">Gratis & Aksesibel</h5>
                            <p class="text-muted small">Memberikan akses ke semua fitur konversi dan kompresi secara gratis, tanpa registrasi.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Team Section -->
            <div class="text-center mt-5 pt-4" data-aos="fade-up" data-aos-delay="200">
                <h2 class="fw-bold mb-5 pb-3">Website ini dikembangkan oleh</h2>
                <div class="row gy-5 justify-content-center">
                    <!-- Team Member 1 -->
                    <div class="col-lg-5 col-md-6">
                        <div class="team-card">
                            <div class="team-image-wrapper">
                                <img src="https://github.com/ReviArda/gambar/blob/main/revi.png?raw=true" alt="Revi Arda Saputra">
                            </div>
                            <div class="team-info">
                                <h4 class="fw-bold mt-3 mb-1">Revi Arda Saputra</h4>
                                <p class="mb-3" style="color: var(--primary-color);">Mahasiswa - 231240001441</p>
                                <div class="team-social">
                                    <a href="#"><i class="fab fa-github"></i></a>
                                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Team Member 2 -->
                    <div class="col-lg-5 col-md-6">
                        <div class="team-card">
                            <div class="team-image-wrapper">
                                <img src="https://github.com/ReviArda/gambar/blob/main/danang.png?raw=true" alt="Danang Yoga Andimas">
                            </div>
                            <div class="team-info">
                                <h4 class="fw-bold mt-3 mb-1">Danang Yoga Andimas</h4>
                                <p class="mb-3" style="color: var(--primary-color);">Mahasiswa - 231240001459</p>
                                <div class="team-social">
                                    <a href="#"><i class="fab fa-github"></i></a>
                                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-5">
                <a href="{{ route('home') }}" class="btn btn-primary">Kembali ke Halaman Utama</a>
            </div>
        </div>
    </div>
</div>
@endsection 