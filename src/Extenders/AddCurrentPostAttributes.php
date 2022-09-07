<?php

namespace ExerciseBook\FofUploadImageX\Extenders;

use ExerciseBook\FofUploadImageX\Configuration\ImageXConfiguration;
use Flarum\Api\Serializer\PostSerializer;
use Flarum\Post\Post;
use FoF\Upload\Repositories\FileRepository;
use Illuminate\Support\Str;

class AddCurrentPostAttributes
{
    /**
     * @var ImageXConfiguration
     */
    private $config;

    /**
     * @var FileRepository
     */
    private $file;

    public function __construct(ImageXConfiguration $config, FileRepository $file)
    {
        $this->config = $config;
        $this->file = $file;
    }

    public function __invoke(PostSerializer $serializer, Post $post, array $attributes): array
    {
        $actor = $serializer->getActor();

        if ($actor->id != $post->user_id || !isset($attributes['content'])) {
            return $attributes;
        }

        if (!isset($attributes['contentType']) || ($attributes['contentType'] !== 'comment')) {
            return $attributes; 
        }

        $content = $attributes['content'];
        $content = $this->replaceImageXBBCode($content);
        $attributes['content'] = $content;

        return $attributes;
    }

    /**
     * @param $content
     * @return string
     */
    private function replaceImageXBBCode($content)
    {
        $regexpr = '/\[upl-imagex-preview[^]]+]/i';

        return preg_replace_callback($regexpr, function ($s) {
            $s = $s[0];
            $kvs = array_filter(explode(' ', $s), function ($it) {
                return Str::contains($it, '=');
            });
            $uuid = false;

            foreach ($kvs as $item) {
                if (Str::startsWith($item, 'uuid=')) {
                    $uuid = substr($item, 5);
                }
            }

            if ($uuid === false) {
                return "";
            }

            $file = $this->file->findByUuid($uuid);
            if ($file == null) {
                return "";
            }

            $uuid = $file->uuid;
            $previewUri = $this->config->generateUrl($file, $this->config->imagePreviewTemplate);
            $fullscreenUri = $this->config->generateUrl($file, $this->config->imageFullscreenTemplate);
            return "[upl-imagex-preview uuid=${uuid} preview_uri=${previewUri} fullscreen_uri=${fullscreenUri}]";
        }, $content);
    }
}