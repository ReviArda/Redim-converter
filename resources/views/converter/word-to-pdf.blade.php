@extends('layouts.app')

@section('title', 'Word ke PDF - Redim Converter')
@section('description', 'Konversi dokumen Word (.doc, .docx) ke format PDF secara online. Mudah, cepat, dan gratis.')

@section('content')
<div class="main-content">
    <!-- Header -->
    <div class="text-center mb-5">
        <div class="feature-icon mx-auto mb-3">
            <i class="fas fa-file-word"></i>
        </div>
        <h1 class="fw-bold text-dark mb-3">Word ke PDF</h1>
        <p class="lead text-muted">
            Konversi dokumen Word (.doc, .docx) ke format PDF dengan mudah
        </p>
        <div class="d-flex justify-content-center gap-2 flex-wrap">
            <span class="badge bg-light text-dark">DOC</span>
            <span class="badge bg-light text-dark">DOCX</span>
            <span class="badge bg-light text-dark">PDF</span>
            <span class="badge bg-light text-dark">Max 10MB</span>
        </div>
    </div>

    <!-- Upload Form -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="upload-area" id="uploadArea">
                <div class="upload-content">
                    <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                    <h4 class="fw-bold mb-2">Drag & Drop file Word di sini</h4>
                    <p class="text-muted mb-3">atau</p>
                    <button type="button" class="btn btn-primary" onclick="document.getElementById('documentInput').click()">
                        <i class="fas fa-folder-open me-2"></i>
                        Pilih File Word
                    </button>
                    <p class="text-muted mt-3 small">
                        Mendukung: DOC, DOCX (Maksimal 10MB per file)
                    </p>
                </div>
                <input type="file" id="documentInput" accept=".doc,.docx" style="display: none;">
            </div>

            <!-- Progress Bar -->
            <div id="progressContainer" style="display: none;" class="mt-4">
                <div class="d-flex justify-content-between mb-2">
                    <span class="fw-bold">Mengkonversi ke PDF...</span>
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
                    <h4 class="fw-bold text-success mb-3">Konversi Berhasil!</h4>
                    
                    <div class="row text-center">
                        <div class="col-md-6">
                            <div class="bg-light p-3 rounded">
                                <h6 class="fw-bold text-muted">File Asli</h6>
                                <p class="h6 fw-bold text-dark" id="originalFileName">-</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-light p-3 rounded">
                                <h6 class="fw-bold text-muted">File Hasil</h6>
                                <p class="h6 fw-bold text-success">PDF</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <a href="#" id="downloadBtn" class="btn btn-success btn-lg me-3" download>
                            <i class="fas fa-download me-2"></i>
                            Download PDF
                        </a>
                        <button type="button" class="btn btn-outline-primary btn-lg" onclick="resetForm()">
                            <i class="fas fa-plus me-2"></i>
                            Konversi File Lain
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features -->
    <div class="row mt-5 pt-5">
        <div class="col-12">
            <h3 class="text-center fw-bold mb-4">Fitur Konversi Word ke PDF</h3>
        </div>
        <div class="col-md-4 text-center mb-4">
            <div class="feature-icon mx-auto mb-3" style="width: 60px; height: 60px; font-size: 1.5rem;">
                <i class="fas fa-sync-alt"></i>
            </div>
            <h5 class="fw-bold">Konversi Cepat</h5>
            <p class="text-muted">Proses konversi yang cepat dan efisien dengan teknologi terbaru.</p>
        </div>
        <div class="col-md-4 text-center mb-4">
            <div class="feature-icon mx-auto mb-3" style="width: 60px; height: 60px; font-size: 1.5rem;">
                <i class="fas fa-eye"></i>
            </div>
            <h5 class="fw-bold">Kualitas Terjaga</h5>
            <p class="text-muted">Hasil konversi mempertahankan format, font, dan layout asli.</p>
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
    const documentInput = $('#documentInput');
    const progressContainer = $('#progressContainer');
    const progressBar = $('#progressBar');
    const progressText = $('#progressText');
    const resultCard = $('#resultCard');
    const originalFileName = $('#originalFileName');
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

    documentInput.on('change', function(e) {
        if (e.target.files.length > 0) {
            handleFile(e.target.files[0]);
        }
    });

    function handleFile(file) {
        // Validate file type
        const validTypes = ['application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
        const validExtensions = ['.doc', '.docx'];
        const fileExtension = file.name.toLowerCase().substring(file.name.lastIndexOf('.'));
        
        if (!validTypes.includes(file.type) && !validExtensions.includes(fileExtension)) {
            alert('Silakan pilih file Word yang valid (DOC, DOCX)');
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
        formData.append('document', file);
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
            url: '{{ route("process.word-to-pdf") }}',
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
                    showResult(response, file.name);
                }, 500);
            },
            error: function(xhr) {
                clearInterval(progressInterval);
                progressContainer.hide();
                
                let errorMessage = 'Terjadi kesalahan saat mengkonversi file.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                
                alert(errorMessage);
            }
        });
    }

    function showResult(response, fileName) {
        if (response.success) {
            originalFileName.text(fileName);
            downloadBtn.attr('href', response.download_url);
            resultCard.show();
        }
    }

    window.resetForm = function() {
        documentInput.val('');
        resultCard.hide();
        progressContainer.hide();
        progressBar.css('width', '0%');
        progressText.text('0%');
    };
});
</script>
@endpush 