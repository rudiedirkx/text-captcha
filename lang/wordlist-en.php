<?php

return [
	'repos' => [
		[
			'labels' => ['fruit', 'fruits'],
			'words' => ['apple', 'banana', 'pear', 'mango', 'kiwi', 'grape', 'strawberry' 'lemon'],
		],
		[
			'labels' => ['body part', 'body parts'],
			'words' => ['arm', 'leg', 'head', 'foot', 'hand', 'tummy', 'breast', 'nose'],
		],
		[
			'labels' => ['color', 'colors'],
			'words' => ['red', 'green', 'yellow', 'blue', 'pink', 'purple', 'brown', 'white'],
		],
		[
			'labels' => ['animal', 'animals'],
			'words' => ['elephant', 'horse', 'cow', 'chicken', 'monkey', 'giraffe', 'rhino', 'cat'],
		],
	],
	'questions_nth' => [
		"What's the __nth__ __repo__ in __list__?",
		"In the list __list__ what's the __nth__ __repo__?",
		"In the list list __list__ what's the __nth__ __repo__?",
		"Of __list__ what's the __nth__ __repo__?",
		"Of list __list__ what's the __nth__ __repo__?",
		"Of list list __list__ what's the __nth__ __repo__?",
	],
	'questions_how_many' => [
		"How many __repo__ in __list__?",
		"How many __repo__ in list __list__?",
		"How many in __list__ are __repo__?",
		"How many in list __list__ are __repo__?",
	],
	'none' => 'none',
	'n' => [
		'zero',
		'one',
		'two',
		'three',
		'four',
	],
	'nth' => [
		'first',
		'second',
		'third',
		'fourth',
	],
];
