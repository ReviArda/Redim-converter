# Redim Converter - Platform Kompresi & Konversi File Online

Platform gratis untuk kompresi dan konversi berbagai jenis file dengan mudah dan cepat. Dibangun dengan Laravel dan teknologi modern.

## 🎯 Fitur Utama

### 📁 Kompresi File
- **Kompres Gambar**: Perkecil ukuran file JPG, PNG, WebP
- **Kompres PDF**: Optimalkan ukuran file PDF tanpa mengurangi kualitas

### 🔄 Konversi File
- **Word ke PDF**: Konversi dokumen .doc/.docx ke PDF
- **Gambar ke PDF**: Gabungkan beberapa gambar menjadi satu file PDF
- **PDF ke JPG**: Ekstrak halaman PDF menjadi gambar JPG
- **PDF ke Word**: Konversi PDF ke dokumen Word yang dapat diedit

## 🛠️ Stack Teknologi

- **Backend**: Laravel 12.x
- **Frontend**: Bootstrap 5, jQuery
- **File Processing**: 
  - `dompdf/dompdf` - PDF generation
  - `intervention/image` - Image manipulation
  - `phpoffice/phpword` - Word document processing
  - `smalot/pdfparser` - PDF parsing
  - `spatie/image-optimizer` - Image optimization

## 📋 Persyaratan Sistem

- PHP 8.2 atau lebih tinggi
- Composer
- Web server (Apache/Nginx) atau PHP built-in server
- Ekstensi PHP yang diperlukan:
  - GD atau Imagick untuk image processing
  - Fileinfo
  - Mbstring
  - XML
  - Zip

## 🚀 Instalasi

1. **Clone repository**
   ```bash
   git clone <repository-url>
   cd redim-converter
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Setup environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Buat direktori storage**
   ```bash
   mkdir -p storage/app/public/{uploads,compressed,converted}
   php artisan storage:link
   ```

5. **Jalankan server**
   ```bash
   php artisan serve
   ```

6. **Akses aplikasi**
   ```
   http://localhost:8000
   ```

## 📁 Struktur Proyek

```
redim-converter/
├── app/
│   └── Http/Controllers/
│       └── FileConverterController.php    # Controller utama
├── resources/views/
│   ├── layouts/
│   │   └── app.blade.php                  # Layout utama
│   └── converter/
│       ├── index.blade.php                # Halaman landing
│       ├── compress-image.blade.php       # Kompres gambar
│       ├── compress-pdf.blade.php         # Kompres PDF
│       ├── word-to-pdf.blade.php          # Word ke PDF
│       ├── image-to-pdf.blade.php         # Gambar ke PDF
│       ├── pdf-to-jpg.blade.php           # PDF ke JPG
│       └── pdf-to-word.blade.php          # PDF ke Word
├── routes/
│   └── web.php                            # Definisi routes
└── storage/app/public/
    ├── uploads/                           # File upload sementara
    ├── compressed/                        # File hasil kompresi
    └── converted/                         # File hasil konversi
```

## 🔧 Konfigurasi

### File Upload Limits
Edit file `php.ini` atau tambahkan ke `.env`:
```ini
upload_max_filesize = 10M
post_max_size = 10M
max_execution_time = 300
memory_limit = 256M
```

### Storage Configuration
Pastikan direktori storage memiliki permission yang tepat:
```bash
chmod -R 755 storage/
chmod -R 755 public/storage/
```

## 🎨 Fitur UI/UX

- **Responsive Design**: Optimized untuk desktop, tablet, dan mobile
- **Drag & Drop**: Upload file dengan drag & drop
- **Progress Bar**: Indikator progress real-time
- **Modern UI**: Desain clean dan profesional dengan Bootstrap 5
- **File Preview**: Preview file sebelum upload
- **Download Manager**: Download hasil konversi dengan mudah

## 🔒 Keamanan

- **File Validation**: Validasi tipe dan ukuran file
- **CSRF Protection**: Proteksi CSRF untuk semua form
- **Auto Cleanup**: File dihapus otomatis setelah 24 jam
- **Secure Storage**: File disimpan di direktori yang aman

## 📊 Performa

- **Image Optimization**: Kompresi gambar dengan kualitas optimal
- **PDF Processing**: Konversi PDF yang cepat dan efisien
- **Memory Management**: Penggunaan memory yang efisien
- **Caching**: Cache untuk meningkatkan performa

## 🧪 Testing

Jalankan test suite:
```bash
php artisan test
```

## 📝 API Endpoints

### Kompresi
- `POST /process/compress-image` - Kompres gambar
- `POST /process/compress-pdf` - Kompres PDF

### Konversi
- `POST /process/word-to-pdf` - Word ke PDF
- `POST /process/image-to-pdf` - Gambar ke PDF
- `POST /process/pdf-to-jpg` - PDF ke JPG
- `POST /process/pdf-to-word` - PDF ke Word

## 🤝 Kontribusi

1. Fork repository
2. Buat feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

## 📄 Lisensi

Proyek ini dilisensikan di bawah MIT License - lihat file [LICENSE](LICENSE) untuk detail.

## 🆘 Support

Jika Anda mengalami masalah atau memiliki pertanyaan:

1. Periksa [Issues](../../issues) untuk solusi yang sudah ada
2. Buat issue baru dengan detail yang lengkap
3. Hubungi tim development

## 🔄 Changelog

### v1.0.0 (2024-01-21)
- ✅ Kompresi gambar (JPG, PNG, WebP)
- ✅ Kompresi PDF
- ✅ Konversi Word ke PDF
- ✅ Konversi gambar ke PDF
- ✅ Konversi PDF ke JPG
- ✅ Konversi PDF ke Word
- ✅ UI/UX modern dan responsive
- ✅ Drag & drop upload
- ✅ Progress bar real-time

---

**Redim Converter** - Platform kompresi dan konversi file online yang aman, cepat, dan gratis! 🚀
