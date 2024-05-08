<?php

namespace SunlightExtend\HoneypotCaptcha;

use Sunlight\Core;
use Sunlight\Logger;
use Sunlight\Plugin\ExtendPlugin;
use Sunlight\Util\StringGenerator;
use Sunlight\Xsrf;

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

    function logRequest(string $message): void
    {
        $submitted_data = $_POST;
        unset($submitted_data['password'], $submitted_data['password2'], $submitted_data[Xsrf::TOKEN_NAME]); // remove sensitive values from log

        $this->log($message, ['submitted_data' => $submitted_data]);
    }

    function log(string $message, array $context): void
    {
        Logger::log($this->getConfig()['logger_level'], 'honeypot-captcha', $message, $context);
    }
}
