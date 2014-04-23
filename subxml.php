<?php
/**
 * subxml
 * 
 * Based on the implementation of substr(),
 * but instead of a string it's able to take
 * the inner text of HTML/XML.
 *
 * @param $string The input string/xml.
 * @param $length The length to trim.
 * @param $boundary Boundary type ['char', 'sentence', 'word']
 * @return String
 */
function subxml($string, $length, $boundary = 'char') {
	$boundary = (!isset($boundary)) ? 'char' : $boundary;
	// Set positioning.
	$pos_char = -1;
	$pos_word = 0;
	$pos_sentence = 0;

	// Assign by reference
	switch($boundary) {
		case 'char':
			$pos = &$pos_char;			
		break;
		case 'word':
			$pos = &$pos_word;
		break;
		case 'sentence':
			$pos = &$pos_sentence;
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
		
		// Counting
		if($io_html === false) {	
			$pos_char++;
			
			if($string[$i]==" " && $string[$i-1]!==" " && $string[$i+1]!==" ") {
				$pos_word++;
			}
			// Matches for the beginning.
			if($boundary==='sentence' 
				&& preg_match('/[a-z](\.|\!\.?)/i', $string[$i-1].$string[$i]) 
				&& $pos<$length) {
				
				while(in_array($string[$i], array('!','?','.'))) {
					$new_string[$i] = $string[$i];
					$i++;
				}
				$pos_sentence++;
			}
		}

		// Write character if it's html OR text.
		if($pos<$length OR $io_html===true) {
			$new_string[$i] = $string[$i];
		}

		// End HTML sequence
		if($string[$i] === '>') { $io_html = false; }
	}
	return implode($new_string);
}