<?php

namespace rdx\textcaptcha;

class CaptchaQuestion {

	protected $question;
	protected $answers;
	protected $type;

	public function __construct(CaptchaType $type, $question, array $answers) {
		$this->type = $type;
		$this->question = $question;
		$this->answers = $answers;
	}

	public function getType() {
		return $this->type->getType();
	}

	public function getQuestion() {
		return $this->question;
	}

	public function getAnswers() {
		return $this->answers;
	}

}
