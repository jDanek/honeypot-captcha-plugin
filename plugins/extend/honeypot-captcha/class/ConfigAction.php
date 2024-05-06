<?php

namespace SunlightExtend\HoneypotCaptcha;

use Sunlight\Logger;
use Sunlight\Plugin\Action\ConfigAction as BaseConfigAction;
use Sunlight\Util\ConfigurationFile;
use Sunlight\Util\Form;

class ConfigAction extends BaseConfigAction
{
    protected function getFields(): array
    {
        $config = $this->plugin->getConfig();

        $fields = parent::getFields();

        $fields['logger_level'] = [
            'label' => _lang('honeypot-captcha.cfg.logger_level'),
            'input' => Form::select(
                'config[logger_level]',
                Logger::LEVEL_NAMES,
                $config['logger_level']
            ),
        ];

        return $fields;
    }

    function getConfigLabel(string $key): string
    {
        return _lang('honeypot-captcha.cfg.' . $key);
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
