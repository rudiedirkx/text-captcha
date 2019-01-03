<?php

namespace rdx\textcaptcha;

class CaptchaMaker {

	protected $types = [];

	static public function createLocal($lang = 'en') : self {
		$maker = new static();
		$maker->add(new ArithmeticCaptcha(new ArithmeticTranslatorLocal(__DIR__ . "/../lang/arithmetic-$lang.php")));
		$maker->add(new WordListCaptcha(new WordListTranslatorLocal(__DIR__ . "/../lang/wordlist-$lang.php")));
		return $maker;
	}

	public function add(CaptchaType $type, $propabilityPart = 100) {
		$this->types[] = [$propabilityPart, $type];
	}

	public function random() : CaptchaType {
		$types = $this->types;
		if (count($types) == 0) {
			throw new NoCaptchaTypesException('There are no captcha types configured. Add them to the maker first.');
		}

		$total = array_reduce($types, function($total, $type) {
			return $total + $type[0];
		}, 0);
		$selection = rand(1, $total);

		$passed = 0;
		foreach ($types as $type) {
			list($chance, $object) = $type;

			if ($selection <= $passed + $chance) {
				return $object;
			}

			$passed += $chance;
		}
	}

	public function make() : CaptchaQuestion {
		$type = $this->random();
		$captcha = $type->make();

		return $captcha;
	}

}
