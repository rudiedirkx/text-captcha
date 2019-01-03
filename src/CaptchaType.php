<?php

namespace rdx\textcaptcha;

abstract class CaptchaType {

	abstract public function getType() : string;

	abstract public function make() : CaptchaQuestion;

}
