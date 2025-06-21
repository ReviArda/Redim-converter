<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class CleanupOldFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'files:cleanup {--hours=24 : Hours to keep files}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up old files from storage';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $hours = $this->option('hours');
        $cutoffTime = Carbon::now()->subHours($hours);
        
        $this->info("Cleaning up files older than {$hours} hours...");
        
        $directories = ['uploads', 'compressed', 'converted'];
        $totalDeleted = 0;
        
        foreach ($directories as $directory) {
            $files = Storage::disk('public')->files($directory);
            
            foreach ($files as $file) {
                $lastModified = Carbon::createFromTimestamp(
                    Storage::disk('public')->lastModified($file)
                );
                
                if ($lastModified->lt($cutoffTime)) {
                    Storage::disk('public')->delete($file);
                    $totalDeleted++;
                    $this->line("Deleted: {$file}");
                }
            }
        }
        
        $this->info("Cleanup completed! Deleted {$totalDeleted} files.");
        
        return 0;
    }
} 