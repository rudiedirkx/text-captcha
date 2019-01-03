<?php

namespace rdx\textcaptcha;

class WordListTranslatorLocal implements WordListTranslator {

	protected $file;
	protected $translations;

	public function __construct($file = __DIR__ . '/../lang/wordlist-en.php') {
		$this->file = $file;
	}

	protected function ensureTranslations() {
		if ($this->translations === null) {
			$this->translations = require $this->file;
		}
	}

	public function repos() : array {
		$this->ensureTranslations();

		return $this->translations['repos'];
	}

	public function question($repo, $n, array $list) : string {
		$this->ensureTranslations();

		$questions = $this->translations['questions'];
		$question = $questions[array_rand($questions)];

		return strtr($question, [
			'__n__' => $n,
			'__nth__' => $this->nth($n),
			'__repo__' => $repo,
			'__list__' => implode(', ', $list),
		]);
	}

	public function nth($n) : string {
		$this->ensureTranslations();

		return $this->translations['nth'][$n - 1];
	}

}
