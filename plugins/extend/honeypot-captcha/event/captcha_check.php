<?php

use Sunlight\User;
use Sunlight\Util\Request;

return function (array $args) {
    if (User::isLoggedIn()) {
        $args['value'] = true;
        return;
    }

    $config = $this->getConfig();

    if (
        Request::post($config['field1_name']) !== ''
        || Request::post($config['field2_name']) !== null
    ) {
        $this->logRequest('The form was submitted with the "honeypot" field filled in');

        // prevent further processing
        $args['value'] = false;
        return;
    }

    if ($config['require_js'] && Request::post($config['js_field_name']) !== $this->getJsToken()) {
        $this->logRequest('The form was submitted without the correct JavaScript token field');

        // prevent further processing
        $args['value'] = false;
        return;
    }

    // allow further processing
    $args['value'] = true;
};
