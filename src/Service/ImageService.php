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
    public function add(UploadedFile $image, ?string $folder = '', ?int $width = 250, ?int $height = 250): string
    {
        $file = md5(uniqid()) . '.webp';

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

        switch($imageWidth <=> $imageHeight) {
            case -1: // portrait
                $squareSize = $imageWidth;
                $srcX = 0;
                $srcY = ($imageHeight - $squareSize) / 2;
                break;
            case 0: // square
                $squareSize = $imageWidth;
                $srcX = 0;
                $srcY = 0;
                break;
            case 1: // landscape
                $squareSize = $imageHeight;
                $srcX = ($imageWidth - $squareSize) / 2;
                $srcY = 0;
                break;
        }

        $resizedImage = imagecreatetruecolor($width, $height);
        imagecopyresampled($resizedImage, $imageSource, 0, 0, $srcX, $srcY, $width, $height, $squareSize, $squareSize);

        $path = $this->params->get('images_directory') . $folder;
        if(!file_exists($path . '/thumbnails/')) {
            mkdir($path . '/thumbnails/', 0755, true);
        }

        imagewebp($resizedImage, $path . '/thumbnails/' . $width . 'x' . $height . '-' . $file);

        $image->move($path . '/', $file);

        return $file;
    }

    public function delete(string $file, ?string $folder = '', ?int $width = 250, ?int $height = 250): bool
    {
        if($file !== 'default.webp') {
            $success = false;
            $path = $this->params->get('images_directory') . $folder;

            $thumbnail = $path . '/thumbnails/' . $width . 'x' . $height . '-' . $file;

            if(file_exists($thumbnail)) {
                unlink($thumbnail);
                $success = true;
            }

            $original = $path . '/' . $file;

            if(file_exists($original)) {
                unlink($original);
                $success = true;
            }

            return $success;
        }

        return false;
    }
}