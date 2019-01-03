Text captcha
====

Create a captcha maker
----

Without any config:

	$maker = CaptchaMaker::createLocal('en'); // or 'nl'

With some custimization:

	$maker = new CaptchaMaker();
	$maker->add(new ArithmeticCaptcha(new ArithmeticTranslatorLocal(__DIR__ . "/lang/arithmetic-$lang.php")), 10);
	$maker->add(new WordListCaptcha(new WordListTranslatorLocal(__DIR__ . "/lang/wordlist-$lang.php")), 20);

`10` and `20` for a `10:20` chance of an `ArithmeticCaptcha`. You can decide which captcha's to use more. Selection is random, but
you decice the relative chance.

Create a random captcha
----

Of a random type:

	$captcha = $maker->make();

Or create the type explicitly, and then the captcha:

	$type = $maker->random();
	$captcha = $type->make();

Translations
----

`nl` and `en` (US) are included. You can add your own language files and select them easily, by manually adding captcha types
with translators.

Or you can get translations from anywhere else, by implementing the correct translators (every captcha type has one), and passing
it to the captcha type.
