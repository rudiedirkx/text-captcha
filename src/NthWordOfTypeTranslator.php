<?php

namespace rdx\textcaptcha;

interface NthWordOfTypeTranslator {

	/** @return array[] */
	public function repos() : array;

	public function repo($repo) : string;

	public function question($repo, $n, array $list) : string;

	public function nth($n) : string;

}
