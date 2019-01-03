<?php

use rdx\textcaptcha\ArithmeticCaptcha;
use rdx\textcaptcha\CaptchaMaker;
use rdx\textcaptcha\ArithmeticTranslatorLocal;
use rdx\textcaptcha\WordListTranslatorLocal;
use rdx\textcaptcha\WordListCaptcha;

require 'vendor/autoload.php';

header('Content-type: text/plain; charset=utf-8');

$lang = 'en';

// $maker = new CaptchaMaker();
// $maker->add(new ArithmeticCaptcha(new ArithmeticTranslatorLocal(__DIR__ . "/lang/arithmetic-$lang.php")));
// $maker->add(new WordListCaptcha(new WordListTranslatorLocal(__DIR__ . "/lang/wordlist-$lang.php")));
$maker = CaptchaMaker::createLocal();

$captcha = $maker->make();
print_r($captcha);
