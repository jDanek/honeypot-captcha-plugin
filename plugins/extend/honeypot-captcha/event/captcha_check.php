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
        $submitted_data = $_POST;
        unset($submitted_data['password'], $submitted_data['password2']);

        Logger::log(
            $config['logger_level'],
            'honeypot-captcha',
            'The form was submitted with the "honeypot" field filled in',
            ['submitted_data' => $submitted_data]
        );

        // prevent further processing
        $args['value'] = false;
        return;
    }

    if ($config['require_js'] && Request::post($config['js_field_name']) !== $this->getJsToken()) {
        Logger::log(
            $config['logger_level'],
            'honeypot-captcha',
            'The form was submitted without the correct JavaScript token field',
            ['submitted_token' => Request::post($config['js_field_name'])]
        );

        // prevent further processing
        $args['value'] = false;
        return;
    }

    // allow further processing
    $args['value'] = true;
};
