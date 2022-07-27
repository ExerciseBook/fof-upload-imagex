<?php

/*
 * This file is part of fof/upload.
 *
 * Copyright (c) FriendsOfFlarum.
 * Copyright (c) Flagrow.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ExerciseBook\FofUploadImageX;

use FoF\Upload\File;
use FoF\Upload\Templates\AbstractTextFormatterTemplate;

class ImageXPreviewTemplate extends AbstractTextFormatterTemplate
{
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
    public function template(): string
    {
        return $this->getView('exercisebook-fof-upload-imagex.templates::imagex-preview');
    }

    /**
     * {@inheritdoc}
     */
    public function bbcode(): string
    {
        return '[upl-imagex-preview uuid={IDENTIFIER} url={URL}]';
    }

    public function preview(File $file): string
    {
        return "[upl-imagex-preview uuid={$file->uuid} url={$file->url}]";
    }
}
