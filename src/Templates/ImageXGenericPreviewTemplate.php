<?php

namespace ExerciseBook\FofUploadImageX\Templates;

use FoF\Upload\File;
use FoF\Upload\Templates\AbstractTextFormatterTemplate;

class ImageXGenericPreviewTemplate extends AbstractTextFormatterTemplate
{
    public const templateName = "upl-imagex-generic-preview";

    /**
     * @var string
     */
    protected $tag = 'imagex-generic-preview';

    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return $this->trans('exercisebook-fof-upload-imagex.admin.template.generic-preview.name');
    }

    /**
     * {@inheritdoc}
     */
    public function description(): string
    {
        return $this->trans('exercisebook-fof-upload-imagex.admin.template.generic-preview.description');
    }

    /**
     * {@inheritdoc}
     */
    public function template(): string
    {
        return $this->getView('exercisebook-fof-upload-imagex.templates::imagex-generic-preview');
    }

    /**
     * {@inheritdoc}
     */
    public function bbcode(): string
    {
        return '[upl-imagex-generic-preview uuid={IDENTIFIER} name={SIMPLETEXT} size={SIMPLETEXT2}]';
    }

    public function preview(File $file): string
    {
        return "[upl-imagex-generic-preview uuid={$file->uuid} name={$file->base_name} size={$file->humanSize}]";
    }
}
