<?php

use Sunlight\User;

return function (array $args): void {
    if (User::isLoggedIn()) {
        return;
    }
    $config = $this->getConfig();

    $honeypotInputs = '<input type="text" name="' . _e($config['field1_name']) . '" value="" tabindex="-1" autocomplete="off">'
        . '<label><input type="checkbox" name="' . _e($config['field2_name']) . '" value="1" tabindex="-1" autocomplete="off"> Very important</label>';

    $args['value'] = [
        'label' => _lang('captcha.input'),
        'content' => '<div class="' . $this->getHoneypotCssClass() . '" aria-hidden="true">' . $honeypotInputs . '</div>',
        'top' => true,
        'class' => $this->getHoneypotCssClass(),
    ];
};
