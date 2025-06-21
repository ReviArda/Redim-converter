<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateFileUpload
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if request has files
        if (!$request->hasFile('image') && 
            !$request->hasFile('pdf') && 
            !$request->hasFile('document') && 
            !$request->hasFile('images')) {
            return response()->json([
                'success' => false,
                'message' => 'No file uploaded'
            ], 400);
        }

        // Get the uploaded file
        $file = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
        } elseif ($request->hasFile('pdf')) {
            $file = $request->file('pdf');
        } elseif ($request->hasFile('document')) {
            $file = $request->file('document');
        } elseif ($request->hasFile('images')) {
            $files = $request->file('images');
            if (is_array($files)) {
                $file = $files[0]; // Check first file for validation
            } else {
                $file = $files;
            }
        }

        if (!$file) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid file upload'
            ], 400);
        }

        // Check file size (10MB limit)
        $maxSize = 10 * 1024 * 1024; // 10MB in bytes
        if ($file->getSize() > $maxSize) {
            return response()->json([
                'success' => false,
                'message' => 'File size too large. Maximum size is 10MB.'
            ], 400);
        }

        // Check file type based on route
        $routeName = $request->route()->getName();
        
        switch ($routeName) {
            case 'process.compress-image':
            case 'process.image-to-pdf':
                if (!$file->isValid() || !in_array($file->getMimeType(), ['image/jpeg', 'image/png', 'image/webp'])) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Invalid image file. Supported formats: JPG, PNG, WebP'
                    ], 400);
                }
                break;
                
            case 'process.compress-pdf':
                if (!$file->isValid() || $file->getMimeType() !== 'application/pdf') {
                    return response()->json([
                        'success' => false,
                        'message' => 'Invalid PDF file'
                    ], 400);
                }
                break;
                
            case 'process.word-to-pdf':
                $validTypes = ['application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
                if (!$file->isValid() || !in_array($file->getMimeType(), $validTypes)) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Invalid Word document. Supported formats: DOC, DOCX'
                    ], 400);
                }
                break;
        }

        return $next($request);
    }
} 