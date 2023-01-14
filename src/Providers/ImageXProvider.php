<?php

namespace ExerciseBook\FofUploadImageX\Providers;

use ExerciseBook\FofUploadImageX\Configuration\ImageXConfiguration;
use ExerciseBook\FofUploadImageX\Templates\ImageXGenericPreviewTemplate;
use ExerciseBook\FofUploadImageX\Templates\ImageXPreviewTemplate;
use ExerciseBook\FofUploadImageX\Templates\ImageXVideoPreviewTemplate;
use ExerciseBook\FofUploadImageX\Templates\ImageXAudioPreviewTemplate;
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
        $util->addRenderTemplate($this->container->make(ImageXVideoPreviewTemplate::class));
        $util->addRenderTemplate($this->container->make(ImageXAudioPreviewTemplate::class));
        $util->addRenderTemplate($this->container->make(ImageXGenericPreviewTemplate::class));
    }
}
