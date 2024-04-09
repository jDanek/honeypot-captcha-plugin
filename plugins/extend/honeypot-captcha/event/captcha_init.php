<?php

return function (array $args): void {
    $this->enableEventGroup('honeypot-captcha');

    $config = $this->getConfig();

    $honeypotInputs = '<input type="text" name="' . _e($config['field1_name']) . '" value="" tabindex="-1" autocomplete="off">'
        . '<label><input type="checkbox" name="' . _e($config['field2_name']) . '" value="1" tabindex="-1" autocomplete="off"> Very important</label>';

    $args['value'] = [
        'label' => '<span aria-hidden="true">' . _lang('captcha.input') . '</span>',
        'content' => '<div class="' . $this->getRandomCssClass() . '" aria-hidden="true">' . $honeypotInputs . '</div>',
        'top' => true,
        'class' => $this->getRandomCssClass(),
    ];
};
