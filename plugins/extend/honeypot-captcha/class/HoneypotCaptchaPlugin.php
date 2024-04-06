<?php

namespace SunlightExtend\HoneypotCaptcha;

use Sunlight\Plugin\ExtendPlugin;
use Sunlight\Plugin\PluginData;
use Sunlight\Plugin\PluginManager;
use Sunlight\Util\StringGenerator;

class HoneypotCaptchaPlugin extends ExtendPlugin
{
    /** @var string */
    public $randomCssClass = '';

    public function __construct(PluginData $data, PluginManager $manager)
    {
        parent::__construct($data, $manager);
        $this->randomCssClass = StringGenerator::generateWordMarkov(rand(7, 12));
    }

    public function getHoneypotCssClass(): string
    {
        return $this->randomCssClass;
    }
}