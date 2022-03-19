<?php

namespace App\Services;

use App\Models\Media;
use Plank\Mediable\Facades\ImageManipulator;
use Plank\Mediable\Facades\MediaUploader;
use Plank\Mediable\Jobs\CreateImageVariants;

class MediaService
{
    public static $thumb = Media::VARIANT_NAME_THUMB;
    public static $medium = Media::VARIANT_NAME_MEDIUM;
    public static $large = Media::VARIANT_NAME_LARGE;

    public static function upload($src, bool $createVariants = true, bool $queue = false)
    {
        $media      = MediaUploader::fromSource($src)
            ->toDirectory('media')
            ->upload();

        if ($createVariants) :
            if ($queue) :
                self::createImageVariantQueue($media);
            else :
                self::createImageVariantNow($media);
            endif;
        endif;

        return $media;
    }

    public static function createImageVariantQueue($media)
    {
        $variants       = [];

        if (self::thumb_enable()) :
            $variants[] = self::$thumb;
        endif;
        if (self::medium_enable()) :
            $variants[] = self::$medium;
        endif;
        if (self::large_enable()) :
            $variants[] = self::$large;
        endif;

        CreateImageVariants::dispatch(
            $media,
            $variants,
        );
    }

    public static function createImageVariantNow($media)
    {
        if (self::thumb_enable()) :
            ImageManipulator::createImageVariant(
                $media,
                self::$thumb,
            );
        endif;

        if (self::medium_enable()) :
            ImageManipulator::createImageVariant(
                $media,
                self::$medium,
            );
        endif;

        if (self::large_enable()) :
            ImageManipulator::createImageVariant(
                $media,
                self::$large,
            );
        endif;
    }

    public static function thumb_enable()
    {
        return true;
    }

    public static function medium_enable()
    {
        return true;
    }

    public static function large_enable()
    {
        return true;
    }
}
