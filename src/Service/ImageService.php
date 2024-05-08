<?php

namespace App\Service;

use Exception;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageService
{
    private ParameterBagInterface $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    /**
     * @throws Exception
     */
    public function add(UploadedFile $image, $name, ?string $folder = '', ?int $width = 150, ?int $widthSmall = 320, ?int $widthMedium = 720, ?int $widthLarge = 1440): string
    {
        $file = $name . '-' . md5(uniqid()) . '.webp';

        $imageInfos = getimagesize($image);
        if($imageInfos === false) {
            throw new Exception('Format d\'image incorrect');
        }

        switch($imageInfos['mime']) {
            case 'image/png':
                $imageSource = imagecreatefrompng($image);
                break;
            case 'image/jpeg':
                $imageSource = imagecreatefromjpeg($image);
                break;
            case 'image/webp':
                $imageSource = imagecreatefromwebp($image);
                break;
            default:
                throw new Exception('Format d\'image incorrect');
        }

        $imageWidth = $imageInfos[0];
        $imageHeight = $imageInfos[1];

        $ratio = $imageHeight / $imageWidth;

        $height = $width * $ratio;
        $heightSmall = $widthSmall * $ratio;
        $heightMedium = $widthMedium * $ratio;
        $heightLarge = $widthLarge * $ratio;
        $srcX = 0;
        $srcY = 0;

        $resizedImage = imagecreatetruecolor($width, $height);
        imagecopyresampled($resizedImage, $imageSource, 0, 0, $srcX, $srcY, $width, $height, $imageWidth, $imageHeight);

        $smallImage = imagecreatetruecolor($widthSmall, $heightSmall);
        imagecopyresampled($smallImage, $imageSource, 0, 0, $srcX, $srcY, $widthSmall, $heightSmall, $imageWidth, $imageHeight);

        $mediumImage = imagecreatetruecolor($widthMedium, $heightMedium);
        imagecopyresampled($mediumImage, $imageSource, 0, 0, $srcX, $srcY, $widthMedium, $heightMedium, $imageWidth, $imageHeight);

        $largeImage = imagecreatetruecolor($widthLarge, $heightLarge);
        imagecopyresampled($largeImage, $imageSource, 0, 0, $srcX, $srcY, $widthLarge, $heightLarge, $imageWidth, $imageHeight);

        $path = $this->params->get('images_directory') . $folder;
        if(!file_exists($path . '/thumbnails/')) {
            mkdir($path . '/thumbnails/', 0755, true);
        }
        if(!file_exists($path . '/small/')) {
            mkdir($path . '/small/', 0755, true);
        }
        if(!file_exists($path . '/medium/')) {
            mkdir($path . '/medium/', 0755, true);
        }
        if(!file_exists($path . '/large/')) {
            mkdir($path . '/large/', 0755, true);
        }

        imagewebp($resizedImage, $path . '/thumbnails/' . $file, 100);
        imagewebp($smallImage, $path . '/small/' . $file, 100);
        imagewebp($mediumImage, $path . '/medium/' . $file, 100);
        imagewebp($largeImage, $path . '/large/' . $file, 100);

        $image->move($path . '/full/', $file);

        return $file;
    }

    public function delete(string $file, ?string $folder = ''): bool
    {
        if($file !== 'default.webp') {
            $success = false;
            $path = $this->params->get('images_directory') . $folder;

            $thumbnail = $path . '/thumbnails/' . $file;
            $small = $path . '/small/' . $file;
            $medium = $path . '/medium/' . $file;
            $large = $path . '/large/' . $file;
            $original = $path . '/full/' . $file;

            if(file_exists($thumbnail)) {
                unlink($thumbnail);
                $success = true;
            }

            if(file_exists($small)) {
                unlink($small);
                $success = true;
            }

            if(file_exists($medium)) {
                unlink($medium);
                $success = true;
            }

            if(file_exists($large)) {
                unlink($large);
                $success = true;
            }

            if(file_exists($original)) {
                unlink($original);
                $success = true;
            }

            return $success;
        }

        return false;
    }
}