<?php

use Sunlight\Core;
use Sunlight\User;

return function (array $args) {
    if (User::isLoggedIn()) {
        return;
    }

    $args['css'][] = $this->getAssetPath('public/css/honeypot.css');
};
