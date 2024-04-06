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
            'field_name' => [
                'label' => _lang('honeypot-captcha.cfg.field_name'),
                'input' => Form::input('text', 'config[field_name]', Request::post('config[field_name]', $config['field_name']), ['class' => 'inputmedium', 'required' => true]),
                'type' => 'text',
            ],
            'field_type' => [
                'label' => _lang('honeypot-captcha.cfg.field_type'),
                'input' => Form::input('text', 'config[field_type]', Request::post('config[field_type]', $config['field_type']), ['class' => 'inputmedium']) . '<br>'
                    . '<small>(checkbox / hidden / number / password / text)</small>',
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
        $allowedInputTypes = [
            'checkbox',
            'hidden',
            'number',
            'password',
            'text',
        ];

        switch ($key) {
            case 'field_type':
                $config[$key] = !in_array($value, $allowedInputTypes) ? 'text' : $value;
                return null;
            case 'logger_level':
                $config[$key] = (int)$value;
                return null;
        }


        return parent::mapSubmittedValue($config, $key, $field, $value);
    }
}
