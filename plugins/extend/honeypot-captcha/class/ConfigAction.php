<?php

namespace SunlightExtend\HoneypotCaptcha;

use Sunlight\Logger;
use Sunlight\Plugin\Action\ConfigAction as BaseConfigAction;
use Sunlight\Util\ConfigurationFile;
use Sunlight\Util\Form;
use Sunlight\Util\Request;

class ConfigAction extends BaseConfigAction
{
    protected function getFields(): array
    {
        $config = $this->plugin->getConfig();

        return [
            'field1_name' => [
                'label' => _lang('honeypot-captcha.cfg.field1_name'),
                'input' => Form::input('text', 'config[field1_name]', Request::post('config[field1_name]', $config['field1_name']), ['class' => 'inputmedium', 'required' => true]),
                'type' => 'text',
            ],
            'field2_name' => [
                'label' => _lang('honeypot-captcha.cfg.field2_name'),
                'input' => Form::input('text', 'config[field2_name]', Request::post('config[field2_name]', $config['field2_name']), ['class' => 'inputmedium', 'required' => true]),
                'type' => 'text',
            ],
            'css_prefix' => [
                'label' => _lang('honeypot-captcha.cfg.css_prefix'),
                'input' => Form::input('text', 'config[css_prefix]', Request::post('config[css_prefix]', $config['css_prefix']), ['class' => 'inputmedium']),
                'type' => 'text',
            ],
            'logger_level' => [
                'label' => _lang('honeypot-captcha.cfg.logger_level'),
                'input' => Form::select(
                    'config[logger_level]',
                    Logger::LEVEL_NAMES,
                    $config['logger_level']
                ),
            ],
        ];
    }

    protected function mapSubmittedValue(ConfigurationFile $config, string $key, array $field, $value): ?string
    {
        switch ($key) {
            case 'css_prefix':
                $config[$key] = trim($value);
                return null;
            case 'logger_level':
                $config[$key] = (int)$value;
                return null;
        }

        return parent::mapSubmittedValue($config, $key, $field, $value);
    }
}
