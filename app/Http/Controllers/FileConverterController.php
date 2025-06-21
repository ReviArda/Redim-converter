<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Dompdf\Dompdf;
use Dompdf\Options;
use Spatie\ImageOptimizer\OptimizerChainFactory;
use Smalot\PdfParser\Parser;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use setasign\Fpdi\Tcpdf\Fpdi;

class FileConverterController extends Controller
{
    public function index()
    {
        return view('converter.index');
    }

    public function compressImage()
    {
        return view('converter.compress-image');
    }

    public function compressPdf()
    {
        return view('converter.compress-pdf');
    }

    public function wordToPdf()
    {
        return view('converter.word-to-pdf');
    }

    public function imageToPdf()
    {
        return view('converter.image-to-pdf');
    }

    // Static Pages
    public function about()
    {
        return view('pages.about');
    }

    public function guide()
    {
        return view('pages.guide');
    }

    // Process methods
    public function processCompressImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:10240'
        ]);

        $file = $request->file('image');
        $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('uploads', $filename, 'public');

        // Compress image using Intervention Image
        $manager = new ImageManager(new Driver());
        $image = $manager->read(storage_path('app/public/' . $path));
        
        // Resize if too large
        if ($image->width() > 1920) {
            $image->scaleDown(1920);
        }
        
        // Ensure the directory exists
        $compressedPath = 'compressed/' . $filename;
        Storage::disk('public')->makeDirectory('compressed');
        $image->save(storage_path('app/public/' . $compressedPath), quality: 80);

        return response()->json([
            'success' => true,
            'original_size' => $file->getSize(),
            'compressed_size' => Storage::disk('public')->size($compressedPath),
            'download_url' => Storage::disk('public')->url($compressedPath)
        ]);
    }

    public function processCompressPdf(Request $request)
    {
        $request->validate([
            'pdf' => 'required|mimes:pdf|max:10240'
        ]);

        try {
            $file = $request->file('pdf');
            $filename = time() . '_' . Str::random(10) . '.pdf';

            $sourcePath = $file->getRealPath();
            $compressedPath = 'compressed/' . $filename;
            $destinationPath = storage_path('app/public/' . $compressedPath);

            // Ensure the directory exists
            Storage::disk('public')->makeDirectory('compressed');

            // Check if ghostscript is available
            $gsPath = shell_exec('which gs 2>/dev/null');
            if (empty($gsPath)) {
                // Fallback: copy original file
                Storage::disk('public')->put($compressedPath, file_get_contents($sourcePath));
                return response()->json([
                    'success' => true,
                    'original_size' => $file->getSize(),
                    'compressed_size' => $file->getSize(),
                    'download_url' => Storage::disk('public')->url($compressedPath),
                    'message' => 'Ghostscript tidak tersedia, file asli dikembalikan.'
                ]);
            }

            // Perintah Ghostscript untuk kompresi
            // Opsi -dPDFSETTINGS=/ebook memberikan kompresi yang baik dengan kualitas baca yang masih bagus.
            $command = sprintf(
                'gs -sDEVICE=pdfwrite -dCompatibilityLevel=1.4 -dPDFSETTINGS=/ebook -dNOPAUSE -dQUIET -dBATCH -sOutputFile=%s %s 2>&1',
                escapeshellarg($destinationPath),
                escapeshellarg($sourcePath)
            );

            // Jalankan perintah
            $output = shell_exec($command);
            
            // Check return code using exec instead
            exec($command . ' 2>&1', $outputArray, $returnCode);

            // Pastikan file hasil dibuat dan tidak kosong
            if ($returnCode !== 0 || !file_exists($destinationPath) || filesize($destinationPath) == 0) {
                // Jika gagal, salin file asli sebagai fallback
                Storage::disk('public')->put($compressedPath, file_get_contents($sourcePath));
                return response()->json([
                    'success' => true,
                    'original_size' => $file->getSize(),
                    'compressed_size' => $file->getSize(),
                    'download_url' => Storage::disk('public')->url($compressedPath),
                    'message' => 'Kompresi Ghostscript gagal, file asli dikembalikan.'
                ]);
            }

            return response()->json([
                'success' => true,
                'original_size' => $file->getSize(),
                'compressed_size' => Storage::disk('public')->size($compressedPath),
                'download_url' => Storage::disk('public')->url($compressedPath)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat kompresi PDF: ' . $e->getMessage()
            ], 500);
        }
    }

    public function processWordToPdf(Request $request)
    {
        $request->validate([
            'document' => 'required|mimes:doc,docx|max:10240'
        ]);

        try {
            $file = $request->file('document');
            $filename = time() . '_' . Str::random(10);
            $path = $file->storeAs('uploads', $filename . '.' . $file->getClientOriginalExtension(), 'public');

            // Convert Word to PDF using PhpWord and DomPDF
            $phpWord = IOFactory::load(storage_path('app/public/' . $path));
            $htmlWriter = IOFactory::createWriter($phpWord, 'HTML');
            $htmlPath = storage_path('app/public/uploads/' . $filename . '.html');
            $htmlWriter->save($htmlPath);

            $html = file_get_contents($htmlPath);
            
            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();

            $pdfPath = 'converted/' . $filename . '.pdf';
            // Ensure the directory exists
            Storage::disk('public')->makeDirectory('converted');
            Storage::disk('public')->put($pdfPath, $dompdf->output());

            // Clean up temporary files
            if (file_exists($htmlPath)) {
                unlink($htmlPath);
            }
            Storage::disk('public')->delete($path);

            return response()->json([
                'success' => true,
                'download_url' => Storage::disk('public')->url($pdfPath)
            ]);
        } catch (\Exception $e) {
            // Clean up any temporary files
            if (isset($htmlPath) && file_exists($htmlPath)) {
                unlink($htmlPath);
            }
            if (isset($path)) {
                Storage::disk('public')->delete($path);
            }
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengkonversi file Word ke PDF. Pastikan file tidak rusak dan formatnya didukung.'
            ], 500);
        }
    }

    public function processImageToPdf(Request $request)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg|max:10240'
        ]);

        $files = $request->file('images');
        $filename = time() . '_' . Str::random(10) . '.pdf';
        
        $dompdf = new Dompdf();
        // Add styling to make each image fit on its own page
        $html = '<html><head><style> body { margin: 0px; } img { width: 100%; page-break-after: always; } </style></head><body>';
        
        foreach ($files as $file) {
            // Get the image content and encode it in Base64
            $imageData = base64_encode(file_get_contents($file->getRealPath()));
            $mimeType = $file->getMimeType();
            $src = 'data:' . $mimeType . ';base64,' . $imageData;

            // Embed the image directly into the HTML
            $html .= '<img src="' . $src . '">';
        }
        
        $html .= '</body></html>';
        
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $pdfPath = 'converted/' . $filename;
        // Ensure the directory exists
        Storage::disk('public')->makeDirectory('converted');
        Storage::disk('public')->put($pdfPath, $dompdf->output());

        return response()->json([
            'success' => true,
            'download_url' => Storage::disk('public')->url($pdfPath)
        ]);
    }
} 