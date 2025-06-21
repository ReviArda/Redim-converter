<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Image Optimizer Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains the configuration for the image optimizer.
    |
    */

    'optimizers' => [
        Spatie\ImageOptimizer\Optimizers\Jpegoptim::class => [
            '--max=85',
            '--strip-all',
            '--all-progressive',
        ],
        Spatie\ImageOptimizer\Optimizers\Pngquant::class => [
            '--force',
        ],
        Spatie\ImageOptimizer\Optimizers\Optipng::class => [
            '-i0',
            '-o2',
            '-quiet',
        ],
        Spatie\ImageOptimizer\Optimizers\Svgo::class => [
            '--disable=cleanupIDs',
        ],
        Spatie\ImageOptimizer\Optimizers\Gifsicle::class => [
            '-b',
            '-O3',
        ],
        Spatie\ImageOptimizer\Optimizers\Cwebp::class => [
            '-m 6',
            '-pass 10',
            '-mt',
            '-q 80',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Logging
    |--------------------------------------------------------------------------
    |
    | Log optimization results
    |
    */
    'log_optimizer_activity' => true,

    /*
    * The paths to the optimizers. Only specify a value if the optimizer is not in a default location.
    */
    'binary_path' => '',

    /*
     * The maximum time in seconds each optimizer is allowed to run.
     */
    'timeout' => 60,
]; 