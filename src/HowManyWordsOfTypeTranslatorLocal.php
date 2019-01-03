<?php

namespace rdx\textcaptcha;

class HowManyWordsOfTypeTranslatorLocal implements HowManyWordsOfTypeTranslator {

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

		return array_map(function($repo) {
			return $repo['words'];
		}, $this->translations['repos']);
	}

	public function none() : string {
		return $this->translations['none'];
	}

	public function number($n) : string {
		return $this->translations['n'][$n];
	}

	public function repo($repo) : string {
		return $this->translations['repos'][$repo]['labels'][1];
	}

	public function question($repo, array $list) : string {
		$this->ensureTranslations();

		$repoTitle = $this->repo($repo);

		$questions = $this->translations['questions_how_many'];
		$question = $questions[array_rand($questions)];

		return strtr($question, [
			'__repo__' => $repoTitle,
			'__list__' => implode(' ', $list),
		]);
	}

}
