<?php

namespace rdx\textcaptcha;

interface WordListTranslator {

	public function repos() : array;

	public function question($repo, $n, array $list) : string;

	public function nth($n) : string;

}
