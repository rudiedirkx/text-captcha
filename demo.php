<?php

use rdx\textcaptcha\ArithmeticCaptcha;
use rdx\textcaptcha\ArithmeticTranslatorLocal;
use rdx\textcaptcha\CaptchaMaker;
use rdx\textcaptcha\HowManyWordsOfTypeCaptcha;
use rdx\textcaptcha\HowManyWordsOfTypeTranslatorLocal;
use rdx\textcaptcha\NthWordOfTypeCaptcha;
use rdx\textcaptcha\NthWordOfTypeTranslatorLocal;

require 'vendor/autoload.php';

header('Content-type: text/plain; charset=utf-8');

$lang = 'nl';

// $maker = new CaptchaMaker();
// $maker->add(new ArithmeticCaptcha(new ArithmeticTranslatorLocal(__DIR__ . "/lang/arithmetic-$lang.php")));
// $maker->add(new NthWordOfTypeCaptcha(new NthWordOfTypeTranslatorLocal(__DIR__ . "/lang/wordlist-$lang.php")));
// $maker->add(new HowManyWordsOfTypeCaptcha(new HowManyWordsOfTypeTranslatorLocal(__DIR__ . "/lang/wordlist-$lang.php")));
$maker = CaptchaMaker::createLocal($lang);

$captcha = $maker->make();
print_r($captcha);
