<?php

namespace rdx\textcaptcha;

interface ArithmeticTranslator {

	public function number($number) : string;

	public function operator($operator) : string;

	public function question($number1, $operator, $number2) : string;

}
