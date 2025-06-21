@extends('layouts.app')

@section('title', 'Gambar ke PDF - Redim Converter')
@section('description', 'Gabungkan beberapa gambar menjadi satu file PDF secara online. Mudah, cepat, dan gratis.')

@section('content')
<div class="main-content">
    <!-- Header -->
    <div class="text-center mb-5">
        <div class="feature-icon mx-auto mb-3">
            <i class="fas fa-images"></i>
        </div>
        <h1 class="fw-bold text-dark mb-3">Gambar ke PDF</h1>
        <p class="lead text-muted">
            Gabungkan beberapa gambar menjadi satu file PDF yang rapi
        </p>
        <div class="d-flex justify-content-center gap-2 flex-wrap">
            <span class="badge bg-light text-dark">JPG</span>
            <span class="badge bg-light text-dark">PNG</span>
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
                    <h4 class="fw-bold mb-2">Drag & Drop gambar di sini</h4>
                    <p class="text-muted mb-3">atau</p>
                    <button type="button" class="btn btn-primary" onclick="document.getElementById('imagesInput').click()">
                        <i class="fas fa-folder-open me-2"></i>
                        Pilih Gambar
                    </button>
                    <p class="text-muted mt-3 small">
                        Mendukung: JPG, PNG (Maksimal 10MB total, Multiple files)
                    </p>
                </div>
                <input type="file" id="imagesInput" accept="image/*" multiple style="display: none;">
            </div>

            <!-- Selected Files Preview -->
            <div id="filesPreview" class="mt-4" style="display: none;">
                <h5 class="fw-bold mb-3">File yang Dipilih:</h5>
                <div id="filesList" class="row g-3"></div>
                <div class="mt-3">
                    <button type="button" class="btn btn-success" onclick="processFiles()">
                        <i class="fas fa-file-pdf me-2"></i>
                        Konversi ke PDF
                    </button>
                    <button type="button" class="btn btn-outline-secondary ms-2" onclick="clearFiles()">
                        <i class="fas fa-times me-2"></i>
                        Hapus Semua
                    </button>
                </div>
            </div>

            <!-- Progress Bar -->
            <div id="progressContainer" style="display: none;" class="mt-4">
                <div class="d-flex justify-content-between mb-2">
                    <span class="fw-bold">Mengkonversi gambar ke PDF...</span>
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
                                <h6 class="fw-bold text-muted">Jumlah Gambar</h6>
                                <p class="h5 fw-bold text-dark" id="imageCount">-</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-light p-3 rounded">
                                <h6 class="fw-bold text-muted">File Hasil</h6>
                                <p class="h5 fw-bold text-success">PDF</p>
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
                            Konversi Gambar Lain
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features -->
    <div class="row mt-5 pt-5">
        <div class="col-12">
            <h3 class="text-center fw-bold mb-4">Fitur Konversi Gambar ke PDF</h3>
        </div>
        <div class="col-md-4 text-center mb-4">
            <div class="feature-icon mx-auto mb-3" style="width: 60px; height: 60px; font-size: 1.5rem;">
                <i class="fas fa-layer-group"></i>
            </div>
            <h5 class="fw-bold">Multiple Images</h5>
            <p class="text-muted">Pilih beberapa gambar sekaligus untuk digabungkan menjadi satu PDF.</p>
        </div>
        <div class="col-md-4 text-center mb-4">
            <div class="feature-icon mx-auto mb-3" style="width: 60px; height: 60px; font-size: 1.5rem;">
                <i class="fas fa-eye"></i>
            </div>
            <h5 class="fw-bold">Kualitas Terjaga</h5>
            <p class="text-muted">Hasil konversi mempertahankan kualitas gambar asli.</p>
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
    const imagesInput = $('#imagesInput');
    const filesPreview = $('#filesPreview');
    const filesList = $('#filesList');
    const progressContainer = $('#progressContainer');
    const progressBar = $('#progressBar');
    const progressText = $('#progressText');
    const resultCard = $('#resultCard');
    const imageCount = $('#imageCount');
    const downloadBtn = $('#downloadBtn');

    let selectedFiles = [];

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
            handleFiles(Array.from(files));
        }
    });

    imagesInput.on('change', function(e) {
        if (e.target.files.length > 0) {
            handleFiles(Array.from(e.target.files));
        }
    });

    function handleFiles(files) {
        const validFiles = files.filter(file => {
            // Validate file type
            if (!file.type.startsWith('image/')) {
                alert(`File ${file.name} bukan file gambar yang valid`);
                return false;
            }

            // Validate file size (10MB)
            if (file.size > 10 * 1024 * 1024) {
                alert(`File ${file.name} terlalu besar. Maksimal 10MB.`);
                return false;
            }

            return true;
        });

        if (validFiles.length > 0) {
            selectedFiles = validFiles;
            showFilesPreview();
        }
    }

    function showFilesPreview() {
        filesList.empty();
        
        selectedFiles.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const fileCard = `
                    <div class="col-md-4 col-sm-6">
                        <div class="card">
                            <img src="${e.target.result}" class="card-img-top" style="height: 150px; object-fit: cover;">
                            <div class="card-body">
                                <h6 class="card-title">${file.name}</h6>
                                <p class="card-text small text-muted">${formatFileSize(file.size)}</p>
                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeFile(${index})">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                `;
                filesList.append(fileCard);
            };
            reader.readAsDataURL(file);
        });

        filesPreview.show();
    }

    function removeFile(index) {
        selectedFiles.splice(index, 1);
        if (selectedFiles.length > 0) {
            showFilesPreview();
        } else {
            filesPreview.hide();
        }
    }

    function clearFiles() {
        selectedFiles = [];
        filesPreview.hide();
        imagesInput.val('');
    }

    function processFiles() {
        if (selectedFiles.length === 0) {
            alert('Silakan pilih gambar terlebih dahulu');
            return;
        }

        const formData = new FormData();
        selectedFiles.forEach(file => {
            formData.append('images[]', file);
        });
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
            url: '{{ route("process.image-to-pdf") }}',
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
                
                let errorMessage = 'Terjadi kesalahan saat mengkonversi gambar.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                
                alert(errorMessage);
            }
        });
    }

    function showResult(response) {
        if (response.success) {
            imageCount.text(selectedFiles.length);
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

    window.removeFile = removeFile;
    window.processFiles = processFiles;
    window.clearFiles = clearFiles;
    window.resetForm = function() {
        clearFiles();
        resultCard.hide();
        progressContainer.hide();
        progressBar.css('width', '0%');
        progressText.text('0%');
    };
});
</script>
@endpush 