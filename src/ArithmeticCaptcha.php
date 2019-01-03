<?php

namespace rdx\textcaptcha;

class ArithmeticCaptcha extends CaptchaType {

	protected $translator;
	protected $options;

	public function __construct(ArithmeticTranslator $translator, array $options = []) {
		$this->translator = $translator;
		$this->options = $options + [
			'max' => 15,
		];
	}

	public function getType() : string {
		return 'arithmetic';
	}

	public function make() : CaptchaQuestion {
		$n1 = rand(1, $this->options['max'] - 1);
		$op = rand(0, 1) ? 'p' : 'm';
		if ($op == 'p') {
			$n2 = rand(0, $this->options['max'] - $n1);
			$answer = $n1 + $n2;
		}
		else {
			$n2 = rand(0, $n1);
			$answer = $n1 - $n2;
		}

		$question = $this->translator->question($n1, $op, $n2);

		$answers = [
			(string) $answer,
			$this->translator->number($answer),
		];

		return new CaptchaQuestion($this, $question, $answers);
	}

}
