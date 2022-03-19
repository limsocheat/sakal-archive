<?php

namespace App\Providers;

use App\Models\Media;
use Illuminate\Support\ServiceProvider;
use Intervention\Image\Image;
use Plank\Mediable\ImageManipulation;
use Plank\Mediable\Facades\ImageManipulator;

class MediaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Mediable Variants
         * thumbnail, medium, large
         * 
         * @see https://laravel-mediable.readthedocs.io/en/latest/variants.html
         */
        ImageManipulator::defineVariant(
            Media::VARIANT_NAME_THUMB,
            ImageManipulation::make(function (Image $image) {
                $image->fit(
                    150,
                    150,
                );
            })->outputJpegFormat()->outputJpegFormat()
                ->beforeSave(function (Media $media) {
                    $media->directory = 'thumb';
                })
        );

        ImageManipulator::defineVariant(
            Media::VARIANT_NAME_MEDIUM,
            ImageManipulation::make(function (Image $image) {
                $image->fit(
                    512,
                    512,
                );
            })->outputJpegFormat()->outputJpegFormat()
                ->beforeSave(function (Media $media) {
                    $media->directory = 'medium';
                })
        );

        ImageManipulator::defineVariant(
            Media::VARIANT_NAME_LARGE,
            ImageManipulation::make(function (Image $image) {
                $image->fit(
                    1024,
                    1024,
                );
            })->outputJpegFormat()->outputJpegFormat()
                ->beforeSave(function (Media $media) {
                    $media->directory = 'large';
                })
        );
    }
}
