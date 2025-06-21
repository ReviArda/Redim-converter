<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Redim Converter - Kompresi & Konversi File Online')</title>
    <meta name="description" content="@yield('description', 'Kompresi dan konversi file online gratis. Konversi Word ke PDF, kompres gambar, kompres PDF, dan banyak lagi.')">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #3b82f6; /* Calm Blue */
            --secondary-color: #64748b; /* Slate Gray */
            --success-color: #22c55e; /* Soft Green */
            --warning-color: #f59e0b; /* Soft Orange */
            --danger-color: #ef4444; /* Soft Red */
            --dark-color: #1e293b;   /* Darker Slate */
            --light-color: #f8fafc;  /* Very Light Gray */
            --text-color: #334155;  /* Main Text Slate */
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: var(--light-color);
            color: var(--text-color);
            min-height: 100vh;
        }

        .navbar {
            background: transparent !important;
            backdrop-filter: blur(10px);
            box-shadow: none;
            border-bottom: 1px solid rgba(226, 232, 240, 0.5);
        }
        
        .navbar-brand, .nav-link {
            color: var(--dark-color) !important;
        }
        
        .navbar-brand {
             font-weight: 600;
        }

        .feature-card {
            background: white;
            border-radius: 16px;
            padding: 2.5rem;
            text-align: center;
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05), 0 1px 2px -1px rgba(0, 0, 0, 0.05);
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.1), 0 4px 6px -4px rgba(59, 130, 246, 0.1);
            border-color: rgba(59, 130, 246, 0.4);
        }

        .feature-icon {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, var(--primary-color) 0%, #818cf8 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: white;
            font-size: 1.75rem;
            box-shadow: 0 4px 10px -2px rgba(59, 130, 246, 0.4);
        }

        .upload-area {
            border: 2px dashed #d1d5db;
            border-radius: 12px;
            padding: 3rem;
            text-align: center;
            transition: all 0.3s ease;
            background-color: #fdfdff;
            cursor: pointer;
        }

        .upload-area:hover, .upload-area.dragover {
            border-color: var(--primary-color);
            background-color: #f0f5fe;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            border-radius: 8px;
            padding: 0.8rem 1.75rem;
            font-weight: 500;
            transition: all 0.2s ease;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
            filter: brightness(1.05);
        }

        .btn-primary .fas {
            transition: transform 0.2s ease-in-out;
        }
        
        .btn-primary:hover .fas {
            transform: translateX(4px);
        }

        .progress {
            height: 8px;
            border-radius: 8px;
            background-color: #e5e7eb;
        }

        .progress-bar {
            background-color: var(--primary-color);
            border-radius: 8px;
        }

        .result-card {
            background-color: #f0f9ff;
            border: 1px solid #e0f2fe;
            border-radius: 12px;
            padding: 2rem;
            margin-top: 2rem;
        }

        .footer {
            background-color: transparent;
            border-top: 1px solid #e5e7eb;
            padding: 2.5rem 0;
            margin-top: 4rem;
            text-align: center;
        }

        /* Team Card Styles */
        .team-card {
            background-color: #ffffff;
            border-radius: 16px;
            padding: 1.5rem;
            transition: all 0.4s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }

        .team-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.15);
        }

        .team-image-wrapper {
            width: 120px;
            height: 120px;
            margin: -70px auto 1rem;
            border-radius: 50%;
            overflow: hidden;
            border: 5px solid #ffffff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .team-image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .team-card:hover .team-image-wrapper img {
            transform: scale(1.1);
        }

        .team-social {
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #e2e8f0;
        }

        .team-social a {
            color: #94a3b8;
            margin: 0 0.5rem;
            font-size: 1.2rem;
            transition: color 0.3s ease;
        }

        .team-card:hover .team-social a {
            color: var(--primary-color);
        }

        .hero-section {
            padding: 4rem 0;
        }

        .hero-section h1 {
            text-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .main-wrapper {
             background: linear-gradient(180deg, #f0f5ff 0%, var(--light-color) 400px);
        }

        .gradient-text {
            background: linear-gradient(45deg, var(--primary-color), #818cf8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-fill-color: transparent;
        }

        .value-prop {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--secondary-color);
        }

        .value-prop .fa-check-circle {
            color: var(--success-color);
        }
    </style>
    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @stack('styles')
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <i class="fas fa-file-archive me-2"></i>
                    Redim Converter
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('guide') }}">Panduan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('about') }}">Tentang Kami</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Fitur
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('compress-image') }}">Kompres Gambar</a></li>
                                <li><a class="dropdown-item" href="{{ route('compress-pdf') }}">Kompres PDF</a></li>
                                <li><a class="dropdown-item" href="{{ route('word-to-pdf') }}">Word ke PDF</a></li>
                                <li><a class="dropdown-item" href="{{ route('image-to-pdf') }}">Gambar ke PDF</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Main Content -->
        <div class="container" style="margin-top: 120px;">
            @yield('content')
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0 text-center text-md-start">
                    <h5>Redim Converter</h5>
                    <p class="text-muted small">Platform kompresi dan konversi file online yang aman dan cepat.</p>
                </div>
                <div class="col-lg-2 col-6 mb-4 mb-lg-0">
                    <h6 class="text-uppercase fw-bold mb-3">Fitur</h6>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('compress-image') }}" class="text-muted text-decoration-none">Kompres Gambar</a></li>
                        <li><a href="{{ route('compress-pdf') }}" class="text-muted text-decoration-none">Kompres PDF</a></li>
                        <li><a href="{{ route('word-to-pdf') }}" class="text-muted text-decoration-none">Word ke PDF</a></li>
                        <li><a href="{{ route('image-to-pdf') }}" class="text-muted text-decoration-none">Gambar ke PDF</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-6 mb-4 mb-lg-0">
                    <h6 class="text-uppercase fw-bold mb-3">Perusahaan</h6>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('about') }}" class="text-muted text-decoration-none">Tentang Kami</a></li>
                        <li><a href="{{ route('guide') }}" class="text-muted text-decoration-none">Panduan</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6 text-center text-md-end">
                    <p class="text-muted small">&copy; {{ date('Y') }} Redim Converter. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 50
        });
    </script>
    @stack('scripts')
</body>
</html> 