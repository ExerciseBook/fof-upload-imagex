<?php

namespace ExerciseBook\FofUploadImageX;

use ExerciseBook\Flysystem\ImageX\ImageXConfig;
use Flarum\Settings\SettingsRepositoryInterface;

class ImageXConfiguration
{
    /**
     * @var ImageXConfig
     */
    public $imagexConfig;

    /**
     * @var string
     */
    public $template;

    public function __construct(SettingsRepositoryInterface $settings)
    {
        if (
            !$settings->get('exercisebook-fof-upload-imagex.imagexConfig.accessKey') ||
            !$settings->get('exercisebook-fof-upload-imagex.imagexConfig.secretKey') ||
            !$settings->get('exercisebook-fof-upload-imagex.imagexConfig.serviceId') ||
            !$settings->get('exercisebook-fof-upload-imagex.imagexConfig.domain')
        ) {
            return null;
        }


        $config = new ImageXConfig();
        $config->region = $settings->get('exercisebook-fof-upload-imagex.imagexConfig.region', 'cn-north-1');
        $config->accessKey = $settings->get('exercisebook-fof-upload-imagex.imagexConfig.accessKey');
        $config->secretKey = $settings->get('exercisebook-fof-upload-imagex.imagexConfig.secretKey');
        $config->serviceId = $settings->get('exercisebook-fof-upload-imagex.imagexConfig.serviceId');
        $config->domain = $settings->get('exercisebook-fof-upload-imagex.imagexConfig.domain');
        $this->template = $this->read_template($settings->get('exercisebook-fof-upload-imagex.imagexConfig.template', ''));

        $this->imagexConfig = $config;
    }

    /**
     * @param $ret
     * @return string
     */
    private function read_template($ret)
    {
        if (!is_string($ret)) {
            $ret = '';
        }

        if (strlen($ret) == 0) {
            return '';
        }

        if (!str_starts_with($ret, '~')) {
            $ret = '~' . $ret;
        }

        if (!str_contains($ret, '.')) {
            $ret .= '.image';
        }

        return $ret;
    }
}