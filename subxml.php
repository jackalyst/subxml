<?php
/**
 * subxml
 * 
 * Based on the implementation of substr(),
 * but instead of a string it's able to take
 * the inner text of HTML/XML, and instead of
 * allowing you to start anywhere, you're only
 * allowed from the beginning.
 *
 * @param $string The input string/xml.
 * @param $length The length to trim.
 * @param $boundary Boundary type [BOUNDARY_WORD, BOUNDARY_CHAR]
 * @return String
 */
function subxml($string, $length, $boundary) {
	// Set positioning.
	$pos_char = 0;
	$pos_word = 0;

	// Assign by reference
	switch($boundary) {
		case BOUNDARY_CHAR:
			$pos = &$pos_char;			
		break;
		case BOUNDARY_WORD:
			$pos = &$pos_word;	
		break;
		default:
			$pos = &$pos_char;
		break;
	}


	// Boolean
	$io_html = false;

	// Split string
	$string = str_split($string);
	
	for ($i=0; $i < count($string); $i++) { 
		// Start HTML sequence.
		if($string[$i] === '<') { $io_html = true; }
		
		// Write character if it's html OR text.
		if($pos<$length OR $io_html===true) {
			$new_string[$i] = $string[$i];
		}

		// Counting.
		if($io_html === false) {	
			$pos_char++;
			
			if($string[$i]==" " && $string[$i-1]!==" " && $string[$i+1]!==" ") {
				$pos_word++;
			}
		}

		// End HTML sequence
		if($string[$i] === '>') { $io_html = false; }
	}
	return implode($new_string);
}