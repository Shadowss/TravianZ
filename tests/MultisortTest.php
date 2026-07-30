<?php

require_once dirname(__DIR__) . '/GameEngine/Multisort.php';

function assertSameMultisort($expected, $actual, $message)
{
	if ($expected !== $actual) {
		fwrite(
			STDERR,
			$message . PHP_EOL .
			'Expected: ' . var_export($expected, true) . PHP_EOL .
			'Actual:   ' . var_export($actual, true) . PHP_EOL
		);
		exit(1);
	}
}

function sortedIds($rows)
{
	return array_column($rows, 'id');
}

$sorter = new multiSort();

$rankings = array(
	array('id' => 'a', 'x' => 0, 'y' => 0, 'pop' => 1),
	array('id' => 'b', 'x' => 1, 'y' => 0, 'pop' => 9),
	array('id' => 'c', 'x' => 0, 'y' => 1, 'pop' => 5),
);

assertSameMultisort(
	array('a', 'c', 'b'),
	sortedIds($sorter->sorte(
		$rankings,
		'x', true, 2,
		'y', true, 2,
		'pop', false, 2
	)),
	'Sort keys must be applied lexicographically in their declared order.'
);

$offers = array(
	array('id' => 'slow', 'duration' => 30),
	array('id' => 'fast', 'duration' => 5),
	array('id' => 'medium', 'duration' => 15),
);

assertSameMultisort(
	array('fast', 'medium', 'slow'),
	sortedIds($sorter->sorte($offers, 'duration', true, 2)),
	'Single-key numeric sorting must retain its existing behavior.'
);

$naturalNames = array(
	array('id' => 'ten', 'name' => 'Item10'),
	array('id' => 'two', 'name' => 'item2'),
	array('id' => 'one', 'name' => 'ITEM1'),
);

assertSameMultisort(
	array('one', 'two', 'ten'),
	sortedIds($sorter->sorte($naturalNames, 'name', true, 1)),
	'Case-insensitive natural sorting must retain its existing behavior.'
);

$ties = array(
	array('id' => 'first', 'score' => 10),
	array('id' => 'second', 'score' => 10),
	array('id' => 'third', 'score' => 10),
);

assertSameMultisort(
	array('first', 'second', 'third'),
	sortedIds($sorter->sorte($ties, 'score', false, 2)),
	'Rows equal across all criteria must retain their input order.'
);

assertSameMultisort(
	$rankings,
	$sorter->sorte($rankings),
	'Calling sorte() without criteria must leave the input unchanged.'
);

echo "Multisort tests passed." . PHP_EOL;
