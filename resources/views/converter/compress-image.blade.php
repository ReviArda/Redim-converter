@extends('layouts.app')

@section('title', 'Kompres Gambar - Redim Converter')
@section('description', 'Kompres gambar JPG, PNG, WebP secara online. Perkecil ukuran file tanpa mengurangi kualitas yang signifikan.')

@section('content')
<div class="main-content">
    <!-- Header -->
    <div class="text-center mb-5">
        <div class="feature-icon mx-auto mb-3">
            <i class="fas fa-image"></i>
        </div>
        <h1 class="fw-bold text-dark mb-3">Kompres Gambar</h1>
        <p class="lead text-muted">
            Perkecil ukuran file gambar tanpa mengurangi kualitas yang signifikan
        </p>
        <div class="d-flex justify-content-center gap-2 flex-wrap">
            <span class="badge bg-light text-dark">JPG</span>
            <span class="badge bg-light text-dark">PNG</span>
            <span class="badge bg-light text-dark">WebP</span>
            <span class="badge bg-light text-dark">Max 10MB</span>
        </div>
    </div>

    <!-- Upload Form -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="upload-area" id="uploadArea">
                <div class="upload-content">
                    <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                    <h4 class="fw-bold mb-2">Drag & Drop file gambar di sini</h4>
                    <p class="text-muted mb-3">atau</p>
                    <button type="button" class="btn btn-primary" onclick="document.getElementById('imageInput').click()">
                        <i class="fas fa-folder-open me-2"></i>
                        Pilih File
                    </button>
                    <p class="text-muted mt-3 small">
                        Mendukung: JPG, PNG, WebP (Maksimal 10MB per file)
                    </p>
                </div>
                <input type="file" id="imageInput" accept="image/*" style="display: none;">
            </div>

            <!-- Progress Bar -->
            <div id="progressContainer" style="display: none;" class="mt-4">
                <div class="d-flex justify-content-between mb-2">
                    <span class="fw-bold">Memproses...</span>
                    <span id="progressText">0%</span>
                </div>
                <div class="progress">
                    <div class="progress-bar" id="progressBar" role="progressbar" style="width: 0%"></div>
                </div>
            </div>

            <!-- Result Card -->
            <div id="resultCard" class="result-card" style="display: none;">
                <div class="text-center">
                    <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                    <h4 class="fw-bold text-success mb-3">Kompresi Berhasil!</h4>
                    
                    <div class="row text-center">
                        <div class="col-md-6">
                            <div class="bg-light p-3 rounded">
                                <h6 class="fw-bold text-muted">Ukuran Asli</h6>
                                <p class="h5 fw-bold text-dark" id="originalSize">-</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-light p-3 rounded">
                                <h6 class="fw-bold text-muted">Ukuran Setelah Kompresi</h6>
                                <p class="h5 fw-bold text-success" id="compressedSize">-</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <a href="#" id="downloadBtn" class="btn btn-success btn-lg me-3" download>
                            <i class="fas fa-download me-2"></i>
                            Download File
                        </a>
                        <button type="button" class="btn btn-outline-primary btn-lg" onclick="resetForm()">
                            <i class="fas fa-plus me-2"></i>
                            Kompres File Lain
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features -->
    <div class="row mt-5 pt-5">
        <div class="col-12">
            <h3 class="text-center fw-bold mb-4">Fitur Kompresi Gambar</h3>
        </div>
        <div class="col-md-4 text-center mb-4">
            <div class="feature-icon mx-auto mb-3" style="width: 60px; height: 60px; font-size: 1.5rem;">
                <i class="fas fa-compress-arrows-alt"></i>
            </div>
            <h5 class="fw-bold">Kompresi Cerdas</h5>
            <p class="text-muted">Algoritma kompresi yang mengoptimalkan ukuran tanpa merusak kualitas visual.</p>
        </div>
        <div class="col-md-4 text-center mb-4">
            <div class="feature-icon mx-auto mb-3" style="width: 60px; height: 60px; font-size: 1.5rem;">
                <i class="fas fa-eye"></i>
            </div>
            <h5 class="fw-bold">Kualitas Terjaga</h5>
            <p class="text-muted">Hasil kompresi tetap mempertahankan kualitas gambar yang baik.</p>
        </div>
        <div class="col-md-4 text-center mb-4">
            <div class="feature-icon mx-auto mb-3" style="width: 60px; height: 60px; font-size: 1.5rem;">
                <i class="fas fa-shield-alt"></i>
            </div>
            <h5 class="fw-bold">Aman & Privat</h5>
            <p class="text-muted">File Anda dihapus otomatis setelah 24 jam. Tidak ada yang dapat mengakses.</p>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    const uploadArea = $('#uploadArea');
    const imageInput = $('#imageInput');
    const progressContainer = $('#progressContainer');
    const progressBar = $('#progressBar');
    const progressText = $('#progressText');
    const resultCard = $('#resultCard');
    const originalSize = $('#originalSize');
    const compressedSize = $('#compressedSize');
    const downloadBtn = $('#downloadBtn');

    // Drag and drop functionality
    uploadArea.on('dragover', function(e) {
        e.preventDefault();
        $(this).addClass('dragover');
    });

    uploadArea.on('dragleave', function(e) {
        e.preventDefault();
        $(this).removeClass('dragover');
    });

    uploadArea.on('drop', function(e) {
        e.preventDefault();
        $(this).removeClass('dragover');
        
        const files = e.originalEvent.dataTransfer.files;
        if (files.length > 0) {
            handleFile(files[0]);
        }
    });

    imageInput.on('change', function(e) {
        if (e.target.files.length > 0) {
            handleFile(e.target.files[0]);
        }
    });

    function handleFile(file) {
        // Validate file type
        if (!file.type.startsWith('image/')) {
            alert('Silakan pilih file gambar yang valid (JPG, PNG, WebP)');
            return;
        }

        // Validate file size (10MB)
        if (file.size > 10 * 1024 * 1024) {
            alert('Ukuran file terlalu besar. Maksimal 10MB.');
            return;
        }

        uploadFile(file);
    }

    function uploadFile(file) {
        const formData = new FormData();
        formData.append('image', file);
        formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

        // Show progress
        progressContainer.show();
        resultCard.hide();

        // Simulate progress
        let progress = 0;
        const progressInterval = setInterval(() => {
            progress += Math.random() * 15;
            if (progress > 90) progress = 90;
            
            progressBar.css('width', progress + '%');
            progressText.text(Math.round(progress) + '%');
        }, 200);

        $.ajax({
            url: '{{ route("process.compress-image") }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            xhr: function() {
                const xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener('progress', function(evt) {
                    if (evt.lengthComputable) {
                        const percentComplete = (evt.loaded / evt.total) * 100;
                        progressBar.css('width', percentComplete + '%');
                        progressText.text(Math.round(percentComplete) + '%');
                    }
                }, false);
                return xhr;
            },
            success: function(response) {
                clearInterval(progressInterval);
                progressBar.css('width', '100%');
                progressText.text('100%');

                setTimeout(() => {
                    progressContainer.hide();
                    showResult(response);
                }, 500);
            },
            error: function(xhr) {
                clearInterval(progressInterval);
                progressContainer.hide();
                
                let errorMessage = 'Terjadi kesalahan saat memproses file.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                
                alert(errorMessage);
            }
        });
    }

    function showResult(response) {
        if (response.success) {
            originalSize.text(formatFileSize(response.original_size));
            compressedSize.text(formatFileSize(response.compressed_size));
            downloadBtn.attr('href', response.download_url);
            resultCard.show();
        }
    }

    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    window.resetForm = function() {
        imageInput.val('');
        resultCard.hide();
        progressContainer.hide();
        progressBar.css('width', '0%');
        progressText.text('0%');
    };
});
</script>
@endpush 