<?php

namespace rdx\textcaptcha;

use ReflectionClass;

abstract class CaptchaType {

	abstract public function make() : CaptchaQuestion;

	public function getType() : string {
		return strtolower(preg_replace('#Captcha$#', '', (new ReflectionClass($this))->getShortName()));
	}

}
