<?php

namespace ExerciseBook\FofUploadImageX\Providers;

use ExerciseBook\FofUploadImageX\Configuration\ImageXConfiguration;
use ExerciseBook\FofUploadImageX\Templates\ImageXPreviewTemplate;
use Flarum\Foundation\AbstractServiceProvider;
use FoF\Upload\Helpers\Util;

class ImageXProvider extends AbstractServiceProvider
{
    public function register()
    {
        $this->container->singleton(ImageXConfiguration::class);

        /** @var Util $util */
        $util = $this->container->make(Util::class);

        $util->addRenderTemplate($this->container->make(ImageXPreviewTemplate::class));
    }
}