<?php

return function (array $args) {
    $args['css_after'] .= "\n<style>." . $this->getRandomCssClass() . ' {clip: rect(0,0,0,0);border: 0;height: 1px;margin: -1px;overflow: hidden;padding: 0;position: absolute;white-space: nowrap;width: 1px;}</style>';
};
