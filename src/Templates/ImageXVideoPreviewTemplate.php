<?php

namespace ExerciseBook\FofUploadImageX\Templates;

use FoF\Upload\File;
use FoF\Upload\Templates\AbstractTextFormatterTemplate;
use Illuminate\Contracts\View\View;

class ImageXVideoPreviewTemplate extends AbstractTextFormatterTemplate
{
    public const templateName = "upl-imagex-video-preview";

    /**
     * @var string
     */
    protected $tag = 'imagex-video-preview';

    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return $this->trans('exercisebook-fof-upload-imagex.admin.template.video-preview.name');
    }

    /**
     * {@inheritdoc}
     */
    public function description(): string
    {
        return $this->trans('exercisebook-fof-upload-imagex.admin.template.video-preview.description');
    }

    /**
     * {@inheritdoc}
     */
    public function template(): View
    {
        return $this->getView('exercisebook-fof-upload-imagex.templates::imagex-video-preview');
    }

    /**
     * {@inheritdoc}
     */
    public function bbcode(): string
    {
        return '[upl-imagex-video-preview uuid={IDENTIFIER} preview_uri={URL} fullscreen_uri={URL}]';
    }

    public function preview(File $file): string
    {
        return "[upl-imagex-video-preview uuid={$file->uuid} preview_uri={$file->url} fullscreen_uri={URL}]";
    }
}
