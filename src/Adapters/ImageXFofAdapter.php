<?php

namespace ExerciseBook\FofUploadImageX\Adapters;

use ExerciseBook\Flysystem\ImageX\ImageXAdapter;
use ExerciseBook\Flysystem\ImageX\ImageXConfig;
use ExerciseBook\FofUploadImageX\Configuration\ImageXConfiguration;
use FoF\Upload\Adapters\Flysystem;
use FoF\Upload\Contracts\UploadAdapter;
use FoF\Upload\File;
use Illuminate\Support\Str;
use League\Flysystem\Config;

class ImageXFofAdapter extends Flysystem implements UploadAdapter
{
    /**
     * @var ImageXConfig ImageX Client Settings
     */
    private $config;

    /**
     * @var array ImageX Client Settings
     */
    private $arrConfig;

    /**
     * @var ImageXConfiguration
     */
    private $pluginConfig;

    /**
     * @param $pluginConfig ImageXConfiguration
     */
    public function __construct($pluginConfig)
    {
        parent::__construct(new ImageXAdapter($pluginConfig->imagexConfig));

        // Save config
        $this->config = $pluginConfig->imagexConfig;

        $arrConfig = [
            'region' => $this->config->region,
            'access_key' => $this->config->accessKey,
            'secret_key' => $this->config->secretKey,
            'service_id' => $this->config->serviceId,
            'domain' => $this->config->domain,
            'template' => $pluginConfig->template,
        ];
        $this->arrConfig = $arrConfig;

        $this->pluginConfig = $pluginConfig;
    }

    protected function getConfig()
    {
        return new Config($this->arrConfig);
    }

    protected function generateUrl(File $file)
    {
        $file->url = $this->pluginConfig->generateUrl($file);
    }
}
