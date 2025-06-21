@extends('layouts.app')

@section('title', 'Panduan Penggunaan - Redim Converter')
@section('description', 'Panduan langkah demi langkah tentang cara menggunakan berbagai fitur di Redim Converter.')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="text-center mb-5">
                <h1 class="display-5 fw-bold">Panduan Penggunaan</h1>
                <p class="lead text-muted">Ikuti langkah-langkah mudah ini untuk menggunakan alat kami.</p>
            </div>

            <div class="accordion" id="guideAccordion">
                <!-- Guide Item 1: General Steps -->
                <div class="accordion-item" style="background-color: #ffffff; border-radius: 12px; border: 1px solid #e2e8f0; margin-bottom: 1rem;">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" style="background-color: #f8fafc; border-radius: 12px;">
                            <strong>Langkah 1: Memilih Fitur yang Diinginkan</strong>
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#guideAccordion">
                        <div class="accordion-body">
                            Dari halaman utama, Anda akan melihat beberapa kartu fitur yang tersedia seperti "Kompres Gambar", "Kompres PDF", "Word ke PDF", dan "Gambar ke PDF". Cukup klik tombol "Mulai Kompres" atau "Mulai Konversi" pada fitur yang ingin Anda gunakan.
                        </div>
                    </div>
                </div>

                <!-- Guide Item 2: Uploading File -->
                <div class="accordion-item" style="background-color: #ffffff; border-radius: 12px; border: 1px solid #e2e8f0; margin-bottom: 1rem;">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="background-color: #f8fafc; border-radius: 12px;">
                            <strong>Langkah 2: Mengunggah File Anda</strong>
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#guideAccordion">
                        <div class="accordion-body">
                            Setelah memilih fitur, Anda akan diarahkan ke halaman unggah. Anda memiliki dua cara untuk mengunggah file:
                            <ul>
                                <li><strong>Klik Area Unggah:</strong> Klik pada kotak putus-putus untuk membuka jendela penjelajah file, lalu pilih file dari komputer Anda.</li>
                                <li><strong>Seret dan Lepas (Drag & Drop):</strong> Cukup seret file dari folder Anda dan lepaskan di area unggah.</li>
                            </ul>
                            Pastikan file yang Anda unggah sesuai dengan format yang didukung oleh fitur tersebut.
                        </div>
                    </div>
                </div>

                <!-- Guide Item 3: Processing and Downloading -->
                <div class="accordion-item" style="background-color: #ffffff; border-radius: 12px; border: 1px solid #e2e8f0;">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" style="background-color: #f8fafc; border-radius: 12px;">
                            <strong>Langkah 3: Proses dan Unduh Hasil</strong>
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#guideAccordion">
                        <div class="accordion-body">
                            Setelah file berhasil diunggah, proses konversi atau kompresi akan dimulai secara otomatis. Anda akan melihat bilah kemajuan (progress bar) yang menunjukkan status proses. Setelah selesai, sebuah kartu hasil akan muncul menampilkan ringkasan (seperti ukuran file sebelum dan sesudah) dan tombol "Unduh File". Klik tombol tersebut untuk menyimpan file hasil ke komputer Anda.
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