<?php

function main(): void
{
	$bookPath = "books/frankenstein.txt";
	$text = getBookText($bookPath);
	$wordCount = getNumWords($text);
	$charsObject = getCharsObject($text);
	$charsSorted = charsObjectToSorted($charsObject);

	print "--- Begin report of $bookPath ---" . PHP_EOL;
	print "$wordCount words found in the document" . PHP_EOL . PHP_EOL;

	foreach ($charsSorted as $char) {
		if (is_int($char['char']) || !ctype_alpha($char['char'])) {
			continue;
		}
		print "The {$char['char']} character was found {$char['num']} times" . PHP_EOL;
	}
	print("--- End Report ---") . PHP_EOL;
}

function getBookText(string $bookPath): string {
	$contents = file_get_contents($bookPath);
	if (!$contents) {
		return "";
	}
	return $contents;
}

function getNumWords(string $text): int {
	$words = explode(" ", $text);
	return count($words);
}

function getCharsObject(string $text): array {
	$chars = [];
	$splitText = str_split($text);
	foreach ($splitText as $c) {
		$lowerC = strtolower($c);
		if (array_key_exists($lowerC, $chars)) {
			++$chars[$lowerC];
		} else {
			$chars[$lowerC] = 1;
		}
	}
	return $chars;
}

function charsObjectToSorted(array $array): array {
	$sorted = [];
	foreach ($array as $char => $count) {
		$sorted[] = [
			'char' => $char,
			'num' => $count
		];
	}
	usort($sorted, static function ($a, $b) {
		return $a['num'] <= $b['num'] ? 1 : -1;
	});

	return $sorted;
}

main();