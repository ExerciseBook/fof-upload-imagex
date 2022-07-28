<?php

namespace ExerciseBook\FofUploadImageX\Listeners;

use ExerciseBook\FofUploadImageX\Adapters\ImageXFofAdapter;
use ExerciseBook\FofUploadImageX\Configuration\ImageXConfiguration;
use FoF\Upload\Events\Adapter\Instantiate;

class AdapterInstantiateListener
{
    /**
     * @var ImageXConfiguration
     */
    protected $config;

    public function __construct(ImageXConfiguration $config)
    {
        $this->config = $config;
    }

    public function handle(Instantiate $event)
    {
        if ($event->adapter != 'imagex') {
            return null;
        }

        return new ImageXFofAdapter($this->config->imagexConfig);
    }
}