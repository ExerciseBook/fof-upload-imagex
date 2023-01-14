<?php

namespace ExerciseBook\FofUploadImageX\Formatters;

use ExerciseBook\FofUploadImageX\Configuration\ImageXConfiguration;
use FoF\Upload\Repositories\FileRepository;
use s9e\TextFormatter\Renderer;
use s9e\TextFormatter\Utils;

class ImageXAudioPreviewFormatter
{
    /**
     * @var FileRepository
     */
    private $files;

    /**
     * @var ImageXConfiguration
     */
    private $config;


    public function __construct(FileRepository $files, ImageXConfiguration $config)
    {
        $this->files = $files;
        $this->config = $config;
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
        return Utils::replaceAttributes($xml, 'UPL-IMAGEX-AUDIO-PREVIEW', function ($attributes) {
            $file = $this->files->findByUuid($attributes['uuid']);
            $preview_url = $this->config->generateUrl($file, $this->config->audioPreviewTemplate);
            $file->url = $preview_url;
            $file->save();

            $attributes["preview_uri"] = $preview_url;
            $attributes["base_name"] = $file->base_name;
            return $attributes;
        });
    }
}
