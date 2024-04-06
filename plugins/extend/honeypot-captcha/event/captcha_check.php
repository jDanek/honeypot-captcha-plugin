<?php

use Sunlight\Logger;
use Sunlight\User;

return function (array $args) {
    if (User::isLoggedIn()) {
        return;
    }

    $config = $this->getConfig();

    if (
        !empty($_REQUEST['_' . $config['field_name']])
        || (
            $config['field_type'] === 'checkbox'
            && !empty($_REQUEST['_' . $config['field_name']])
            && (bool)$_REQUEST['_' . $config['field_name']] === true
        )
    ) {
        // remove passwords from log
        $submittedData = array_map(function ($k, $v) {
            if ($k === 'password' || $k === 'password2') {
                return str_repeat('*', strlen($v));
            } else {
                return $v;
            }
        }, array_keys($_REQUEST), $_REQUEST);

        Logger::log(
            $config['logger_level'],
            'honeypot-captcha',
            'The form was submitted with the "honeypot" field filled in.',
            ['submitted_data' => array_combine(array_keys($_REQUEST), $submittedData)]
        );

        // prevent further processing
        $args['value'] = false;
        return;
    }

    // allow further processing
    $args['value'] = true;
};
