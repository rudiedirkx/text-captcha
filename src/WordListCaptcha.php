<?php

namespace rdx\textcaptcha;

class WordListCaptcha extends CaptchaType {

	protected $translator;
	protected $options;

	public function __construct(WordListTranslator $translator, array $options = []) {
		$this->translator = $translator;
		$this->options = $options + [
			'size' => 6,
			'inject' => 3,
		];
	}

	public function getType() : string {
		return 'wordlist';
	}

	public function make() : CaptchaQuestion {
		$_repos = $this->translator->repos();
		$_size = $this->options['size'];
		$_inject = $this->options['inject'];

		$repo = array_rand($_repos);

		$all = array_merge(...array_values(array_diff_key($_repos, [$repo => 1])));
		shuffle($all);

		$injects = $_repos[$repo];
		shuffle($injects);
		$injects = array_slice($injects, 0, rand(1, $_inject));
		while ($inject = array_pop($injects)) {
			array_splice($all, rand(0, $_size-1), 0, $inject);
		}

		$list = array_slice($all, 0, $_size);
		$potentials = array_values(array_intersect($list, $_repos[$repo]));
		$which = array_rand($potentials) + 1;
		$answer = $potentials[$which - 1];

		$question = $this->translator->question($repo, $which, $list);

		return new CaptchaQuestion($this, $question, [$answer]);
	}

}
