<?php

use Sunlight\Logger;
use Sunlight\Util\Request;

return function (array $args) {
    $config = $this->getConfig();

    if (
        Request::post($config['field1_name']) !== ''
        || Request::post($config['field2_name']) !== null
    ) {
        // remove passwords from log
        unset($_POST['password'], $_POST['password2']);
        Logger::log(
            $config['logger_level'],
            'honeypot-captcha',
            'The form was submitted with the "honeypot" field filled in.',
            ['submitted_data' => $_POST]
        );

        // prevent further processing
        $args['value'] = false;
        return;
    }

    // allow further processing
    $args['value'] = true;
};
