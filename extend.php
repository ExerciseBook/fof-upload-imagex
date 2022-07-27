<?php

namespace ExerciseBook\FofUploadImageX;

use Flarum\Extend;
use FoF\Upload\Events\Adapter\Collecting;
use FoF\Upload\Events\Adapter\Instantiate;

return [
    (new Extend\Event)
        ->listen(Collecting::class, AdapterRegisterListener::class)
        ->listen(Instantiate::class, AdapterInstantiateListener::class),

    (new Extend\Frontend('admin'))
        ->js(__DIR__ . '/js/dist/admin.js'),

    new Extend\Locales(__DIR__ . '/resources/locale'),

    (new Extend\View())
        ->namespace('exercisebook-fof-upload-imagex.templates', __DIR__ . '/resources/templates'),


    (new Extend\ServiceProvider())
        ->register(ImageXProvider::class),

    (new Extend\Formatter())
        ->render(ImageXPreviewFormatter::class),
];
