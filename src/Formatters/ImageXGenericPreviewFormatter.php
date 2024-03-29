<?php

namespace ExerciseBook\FofUploadImageX\Formatters;

use FoF\Upload\Repositories\FileRepository;
use s9e\TextFormatter\Renderer;
use s9e\TextFormatter\Utils;

class ImageXGenericPreviewFormatter
{
    /**
     * @var FileRepository
     */
    private $files;

    public function __construct(FileRepository $files)
    {
        $this->files = $files;
    }

    /**
     * Configure rendering for text preview uploads.
     *
     * @param Renderer $renderer
     * @param mixed $context
     * @param string $xml
     *
     * @return string $xml to be rendered
     */
    public function __invoke(Renderer $renderer, $context, string $xml)
    {
        return Utils::replaceAttributes($xml, 'UPL-IMAGEX-GENERIC-PREVIEW', function ($attributes) {
            $file = $this->files->findByUuid($attributes['uuid']);
            $attributes["name"] = $file->base_name;
            $attributes["size"] = $file->humanSize;
            return $attributes;
        });
    }
}
