<?php

use Sunlight\User;

return function (array $args) {
    if (User::isLoggedIn()) {
        return;
    }

    $args['css_after'] .= '<style>.' . $this->getHoneypotCssClass() . ' {
        clip: rect(0,0,0,0);
        border: 0;
        height: 1px;
        margin: -1px;
        overflow: hidden;
        padding: 0;
        position: absolute;
        white-space: nowrap;
        width: 1px;
    }</style>';
};