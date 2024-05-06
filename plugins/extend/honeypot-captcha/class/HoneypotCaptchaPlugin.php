<?php

namespace SunlightExtend\HoneypotCaptcha;

use Sunlight\Core;
use Sunlight\Plugin\ExtendPlugin;
use Sunlight\Util\StringGenerator;

class HoneypotCaptchaPlugin extends ExtendPlugin
{
    /** @var string|null */
    private $randomCssClass;
    /** @var string|null */
    private $jsToken;

    function getRandomCssClass(): string
    {
        return $this->randomCssClass ?? ($this->randomCssClass = $this->getConfig()['css_prefix'] . StringGenerator::generateWordMarkov(random_int(7, 12)));
    }

    function getJsToken(): string
    {
        return $this->jsToken ?? ($this->jsToken = hash_hmac('sha1', $this->getConfig()['js_field_name'], Core::$secret));
    }
}
