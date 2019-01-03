<?php

namespace rdx\textcaptcha;

class ArithmeticTranslatorLocal implements ArithmeticTranslator {

	protected $file;
	protected $translations;

	public function __construct($file = __DIR__ . '/../lang/arithmetic-en.php') {
		$this->file = $file;
	}

	protected function ensureTranslations() {
		if ($this->translations === null) {
			$this->translations = require $this->file;
		}
	}

	public function number($number) : string {
		$this->ensureTranslations();

		return $this->translations['numbers'][$number];
	}

	public function operator($operator) : string {
		$this->ensureTranslations();

		return $this->translations['operators'][$operator];
	}

	public function question($number1, $operator, $number2) : string {
		$number1 = $this->number($number1);
		$operator = $this->operator($operator);
		$number2 = $this->number($number2);

		return "$number1 $operator $number2";
	}

}
