<?php

namespace rdx\textcaptcha;

interface HowManyWordsOfTypeTranslator {

	/** @return array[] */
	public function repos() : array;

	public function repo($repo) : string;

	public function question($repo, array $list) : string;

	public function number($n) : string;

	public function none() : string;

}
