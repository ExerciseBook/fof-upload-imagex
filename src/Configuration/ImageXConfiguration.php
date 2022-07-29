<?php

namespace ExerciseBook\FofUploadImageX\Configuration;

use ExerciseBook\Flysystem\ImageX\ImageXConfig;
use Flarum\Settings\SettingsRepositoryInterface;
use FoF\Upload\File;
use Illuminate\Support\Str;

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

    /**
     * @var string
     */
    public $fileRetrievingSignatureToken;

    public function __construct(SettingsRepositoryInterface $settings)
    {
        $config = new ImageXConfig();
        $config->region = $settings->get('exercisebook-fof-upload-imagex.imagexConfig.region', 'cn-north-1');
        if ($config->region == null || strlen($config->region) == 0) {
            $config->region = 'cn-north-1';
        }
        $config->accessKey = $settings->get('exercisebook-fof-upload-imagex.imagexConfig.accessKey');
        $config->secretKey = $settings->get('exercisebook-fof-upload-imagex.imagexConfig.secretKey');
        $config->serviceId = $settings->get('exercisebook-fof-upload-imagex.imagexConfig.serviceId');
        $config->domain = $settings->get('exercisebook-fof-upload-imagex.imagexConfig.domain');
        $this->template = $this->read_template($settings->get('exercisebook-fof-upload-imagex.imagexConfig.imagePreviewTemplate', ''));
        $this->fileRetrievingSignatureToken = $settings->get('exercisebook-fof-upload-imagex.imagexConfig.fileRetrievingSignatureToken', '');
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

    /**
     * @return bool
     */
    public function needSignature()
    {
        return $this->fileRetrievingSignatureToken != null && strlen($this->fileRetrievingSignatureToken) > 0;
    }

    /**
     * @return bool
     */
    public function hasTemplate()
    {
        return $this->template != null && strlen($this->template) > 0;
    }

    /**
     * @param $signPath string
     * @return string
     */
    public function signPath($signPath)
    {
        $sign_ts = time();
        $sign_payload = sprintf("%s%s%x", $this->fileRetrievingSignatureToken, $signPath, $sign_ts);
        $sign = strtolower(md5($sign_payload));
        return sprintf("%s/%s/%x%s", $this->imagexConfig->domain, $sign, $sign_ts, $signPath);
    }

    /**
     * @param $file File
     * @return string
     */
    public function generateUrl($file)
    {
        if ($this->needSignature()) {
            if (Str::startsWith($file->type, 'image/') && $this->hasTemplate()) {
                return "//" . $this->signPath('/' . $file->path . $this->template);
            } else {
                return "//" . $this->signPath('/' . $file->path);
            }
        } else {
            if (Str::startsWith($file->type, 'image/') && $this->hasTemplate()) {
                return "//" . $this->imagexConfig->domain . '/' . $file->path . $this->template;
            } else {
                return "//" . $this->imagexConfig->domain . '/' . $file->path;
            }
        }
    }
}