<?php

namespace rdx\textcaptcha;

class HowManyWordsOfTypeCaptcha extends CaptchaType {

	protected $translator;
	protected $options;

	public function __construct(HowManyWordsOfTypeTranslator $translator, array $options = []) {
		$this->translator = $translator;
		$this->options = $options + [
			'size' => 6,
			'min' => 0,
			'max' => 4,
		];
	}

	public function make() : CaptchaQuestion {
		$_repos = $this->translator->repos();
		$_size = $this->options['size'];
		$_inject = rand($this->options['min'], $this->options['max']);

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
		$matches = count(array_values(array_intersect($list, $_repos[$repo])));

		$question = $this->translator->question($repo, $list);

		$answers = [
			$matches,
			$this->translator->number($matches),
		];
		if ($matches == 0) {
			$answers[] = $this->translator->none();
		}

		return new CaptchaQuestion($this, $question, $answers);
	}

}
