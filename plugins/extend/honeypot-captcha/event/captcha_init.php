<?php

use Sunlight\Util\Form;

return function (array $args): void {
    $this->enableEventGroup('honeypot-captcha');

    $config = $this->getConfig();

    $args['value'] = [
        'content' => Form::input('text', $config['field1_name'], '', ['tabindex' => '-1', 'autocomplete' => 'off'])
            . "\n"
            . Form::input('checkbox', $config['field2_name'], '1', ['tabindex' => '-1']),
        'class' => $this->getRandomCssClass(),
    ];
};
