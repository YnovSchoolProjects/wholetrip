<?php


namespace App\Controller;


use App\Entity\Media;
use App\Exception\NullMimeTypeException;
use App\Factory\MediaCreationFactory;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class CreateMediaAction
{
    private MediaCreationFactory $mediaFactory;

    public function __construct(MediaCreationFactory $mediaFactory)
    {
        $this->mediaFactory = $mediaFactory;
    }

    public function __invoke(Request $request): Media
    {
        $uploadedFile = $request->files->get('file');
        if (!$uploadedFile) {
            throw new BadRequestHttpException('"file" is required');
        }

        return $this->mediaFactory->buildMedia($uploadedFile);
    }
}
