<?php


namespace App\Factory;


use App\Entity\Media;
use App\Entity\Photo;
use App\Entity\Video;
use App\Exception\NullMimeTypeException;
use App\Exception\UnsupportedMimeTypeException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class MediaCreationFactory
{

    public const imageMediaMimeType = ['image/gif', 'image/jpeg', 'image/png', 'image/svg+xml', 'image/webp'];
    public const videoMediaMimeType = ['video/webm', 'video/x-msvideo', 'video/mpeg', 'video/ogg'];

    public function buildMedia(UploadedFile $file): Media
    {
        $mimeType = $file->getMimeType();

        if (null === $mimeType) {
            throw new NullMimeTypeException();
        }

        if (in_array($mimeType, static::imageMediaMimeType)) {
            $media = new Photo();
        } elseif (in_array($mimeType, static::videoMediaMimeType)) {
            $media = new Video();
        } else {
            throw new UnsupportedMimeTypeException();
        }

        $media->setFile($file);

        return $media;
    }

}
