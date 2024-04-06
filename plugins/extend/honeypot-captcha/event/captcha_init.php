<?php

use Sunlight\User;

return function (array $args): void {
    if (User::isLoggedIn()) {
        return;
    }
    $config = $this->getConfig();

    $honeypotInput = '<input id="very_important" type="' . _e($config['field_type']) . '" name="_' . _e($config['field_name']) . '" value="' . ($config['field_type'] === 'checkbox' ? '1' : '') . '" tabindex="-1" autocomplete="off">';
    $args['value'] = [
        'label' => _lang('captcha.input'),
        'content' => '<div id="very_important" aria-hidden="true"><label>' . $honeypotInput . ' Very important</label></div>',
        'top' => true,
        'class' => 'topyenoh',
    ];
};
