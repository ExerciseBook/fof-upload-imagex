<?php

namespace ExerciseBook\FofUploadImageX\Templates;

use FoF\Upload\File;
use FoF\Upload\Templates\AbstractTextFormatterTemplate;
use Illuminate\Contracts\View\View;

class ImageXPreviewTemplate extends AbstractTextFormatterTemplate
{
    public const templateName = "upl-imagex-preview";

    /**
     * @var string
     */
    protected $tag = 'imagex-preview';

    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return $this->trans('exercisebook-fof-upload-imagex.admin.template.image-preview.name');
    }

    /**
     * {@inheritdoc}
     */
    public function description(): string
    {
        return $this->trans('exercisebook-fof-upload-imagex.admin.template.image-preview.description');
    }

    /**
     * {@inheritdoc}
     */
    public function template(): View
    {
        return $this->getView('exercisebook-fof-upload-imagex.templates::imagex-preview');
    }

    /**
     * {@inheritdoc}
     */
    public function bbcode(): string
    {
        return '[upl-imagex-preview uuid={IDENTIFIER} preview_uri={URL} fullscreen_uri={URL}]';
    }

    public function preview(File $file): string
    {
        return "[upl-imagex-preview uuid={$file->uuid} preview_uri={$file->url} fullscreen_uri={URL}]";
    }
}
