<?php

namespace ExerciseBook\FofUploadImageX\Formatters;

use ExerciseBook\FofUploadImageX\Configuration\ImageXConfiguration;
use FoF\Upload\Repositories\FileRepository;
use Illuminate\Support\Str;
use s9e\TextFormatter\Renderer;
use s9e\TextFormatter\Utils;

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

            if ($this->config->needSignature()) {
                if (Str::startsWith($file->type, 'image/') && strlen($this->config->template) > 0) {
                    $attributes["url"] = "//" . $this->config->signPath('/' . $file->path . $this->config->template);
                } else {
                    $attributes["url"] = "//" . $this->config->signPath('/' . $file->path);
                }
            } else {
                if (Str::startsWith($file->type, 'image/') && strlen($this->config->template) > 0) {
                    $attributes["url"] = "//" . $this->imagexConfig->domain . '/' . $file->path . $this->config->template;
                } else {
                    $attributes["url"] = "//" . $this->imagexConfig->domain . '/' . $file->path;
                }
            }

            $attributes["base_name"] = $file->base_name;
            return $attributes;
        });
    }
}
