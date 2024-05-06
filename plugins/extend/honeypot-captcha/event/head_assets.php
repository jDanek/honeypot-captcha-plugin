<?php

use Sunlight\Util\Form;
use Sunlight\Util\Json;

return function (array $args) {
    $selector = '.' . $this->getRandomCssClass();

    $args['css_after'] .= "\n<style>{$selector} {clip:rect(0,0,0,0);border:0;height:1px;margin:-1px;overflow:hidden;padding:0;position:absolute;white-space:nowrap;width:1px;}</style>";
    $args['js_after'] .= "\n<script>\$(function(){\$(" . Json::encodeForInlineJs('.' . $this->getRandomCssClass()) . ").attr('aria-hidden', 'true');});</script>";

    if ($this->getConfig()['require_js']) {
        $jsInput = Json::encodeForInlineJs(Form::input('hidden', $this->getConfig()['js_field_name'], $this->getJsToken()));
        $args['js_after'] .= "\n<script>\$(function(){\$(" . Json::encodeForInlineJs("{$selector} input[name={$this->getConfig()['field2_name']}]") . ").after({$jsInput});});</script>";
    }
};
