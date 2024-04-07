<?php

namespace SunlightExtend\HoneypotCaptcha;

use Sunlight\Plugin\ExtendPlugin;
use Sunlight\Util\StringGenerator;

class HoneypotCaptchaPlugin extends ExtendPlugin
{
    /** @var string */
    private $randomCssClass;

    function getRandomCssClass(): string
    {
        return $this->randomCssClass ?? ($this->randomCssClass = $this->getConfig()['css_prefix'] . StringGenerator::generateWordMarkov(random_int(7, 12)));
    }
}