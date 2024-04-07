<?php

use Sunlight\Logger;
use Sunlight\User;
use Sunlight\Util\Request;

return function (array $args) {
    $config = $this->getConfig();

    if (
        Request::post($config['field1_name']) !== ''
        || Request::post($config['field2_name']) !== null
    ) {
        // remove passwords from log
        $submittedData = array_map(function ($k, $v) {
            if ($k === 'password' || $k === 'password2') {
                return str_repeat('*', strlen($v));
            } else {
                return $v;
            }
        }, array_keys($_POST), $_POST);

        Logger::log(
            $config['logger_level'],
            'honeypot-captcha',
            'The form was submitted with the "honeypot" field filled in.',
            ['submitted_data' => array_combine(array_keys($_POST), $submittedData)]
        );

        // prevent further processing
        $args['value'] = false;
        return;
    }

    // allow further processing
    $args['value'] = true;
};
