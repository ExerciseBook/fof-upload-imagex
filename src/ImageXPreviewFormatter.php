<?php

namespace ExerciseBook\FofUploadImageX;

use Flarum\Foundation\Paths;
use FoF\Upload\Repositories\FileRepository;
use s9e\TextFormatter\Renderer;
use s9e\TextFormatter\Utils;
use Symfony\Contracts\Translation\TranslatorInterface;

class ImageXPreviewFormatter
{
    /**
     * @var FileRepository
     */
    private $files;

    /**
     * @var \ExerciseBook\Flysystem\ImageX\ImageXConfig
     */
    private $imagexConfig;

    /**
     * @var ImageXConfiguration
     */
    private $config;


    public function __construct(FileRepository $files, ImageXConfiguration $config)
    {
        $this->files = $files;
        $this->imagexConfig = $config->imagexConfig;
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
        return Utils::replaceAttributes($xml, 'UPL-IMAGEX-PREVIEW', function ($attributes) {
            $file = $this->files->findByUuid($attributes['uuid']);

            if (strlen($this->config->template) == 0) {
                $attributes["url"] = "//" . $this->imagexConfig->domain . '/' . $file->path;
            } else {
                $attributes["url"] = "//" . $this->imagexConfig->domain . '/' . $file->path . $this->config->template;
            }

            $attributes["base_name"] = $file->base_name;
            return $attributes;
        });
    }
}
