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
		$this->ensureTranslations();

		$questions = $this->translations['questions'];
		$question = $questions[array_rand($questions)];

		$number1 = $this->number($number1);
		$operator = $this->operator($operator);
		$number2 = $this->number($number2);

		return strtr($question, [
			'__a__' => $number1,
			'__op__' => $operator,
			'__b__' => $number2,
		]);
	}

}
