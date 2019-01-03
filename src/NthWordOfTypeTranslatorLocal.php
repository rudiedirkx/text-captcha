<?php

namespace rdx\textcaptcha;

class NthWordOfTypeTranslatorLocal implements NthWordOfTypeTranslator {

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

	public function repo($repo) : string {
		return $this->translations['repos'][$repo]['labels'][0];
	}

	public function question($repo, $n, array $list) : string {
		$this->ensureTranslations();

		$repoTitle = $this->repo($repo);

		$questions = $this->translations['questions_nth'];
		$question = $questions[array_rand($questions)];

		return strtr($question, [
			'__n__' => $n,
			'__nth__' => $this->nth($n),
			'__repo__' => $repoTitle,
			'__list__' => implode(' ', $list),
		]);
	}

	public function nth($n) : string {
		$this->ensureTranslations();

		return $this->translations['nth'][$n - 1];
	}

}
