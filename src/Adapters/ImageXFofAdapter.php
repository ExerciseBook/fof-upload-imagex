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
     * @var string Resources uri Prefix
     */
    private $uriPrefix;

    /**
     * @var ImageXConfig ImageX Client Settings
     */
    private $config;

    /**
     * @var array ImageX Client Settings
     */
    private $arrConfig;

    /**
     * @param $config ImageXConfiguration
     */
    public function __construct($config)
    {
        parent::__construct(new ImageXAdapter($config->imagexConfig));

        // Save config
        $this->config = $config->imagexConfig;

        $arrConfig = [
            'region' => $this->config->region,
            'access_key' => $this->config->accessKey,
            'secret_key' => $this->config->secretKey,
            'service_id' => $this->config->serviceId,
            'domain' => $this->config->domain,
            'template' => $config->template,
        ];

        $this->arrConfig = $arrConfig;
        $this->uriPrefix = $this->adapter->imageXBuildUriPrefix();
    }

    protected function getConfig()
    {
        return new Config($this->arrConfig);
    }

    protected function generateUrl(File $file)
    {
        $type = mb_strtolower($file->type);
        $path = $file->getAttribute('path');
        $template = $this->arrConfig['template'];

        if (Str::startsWith($type, 'image/') && $template) {
            $url = '//' . $this->config->domain . '/' . $this->uriPrefix . '/' . $path . $template;
        } else {
            $url = '//' . $this->config->domain . '/' . $this->uriPrefix . '/' . $path;
        }
        $file->url = $url;
    }
}
