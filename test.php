<style>* {margin:0; padding:0; } body {font-family: sans-serif; } div {border: 3px solid #400; color:#400; background-color: #FFEEEE; padding:5px; margin:5px; } div * {margin:3px; } div pre {background-color: rgba(255,255,255,0.7); border: 1px solid rgba(0,0,0,0.2); padding: 3px; } </style>
<?php
/** 
 * Very basic testing.
 */
include "subxml.php";

function compare($test_input, $test_output, $output, $test) {
	if ($output!==$test_output) {
		echo '<div>';
		echo '<h3>'.$test.'</h3>';
		echo 'Input:';
		echo '<pre>'.htmlentities($test_input).'</pre>';
		echo 'Output:';
		echo '<pre>'.htmlentities($output).'</pre>';
		echo 'Expected Output:';
		echo '<pre>'.htmlentities($test_output).'</pre>';
		echo '</div>';
	} else {
		echo "<h3>Passed</h3>";
	}
}

/*  */
$test_input  = "<p>This will to 'this'</p>";
$test_output = '<p>This</p>';
     $output = subxml($test_input, 4);

compare(
	$test_input, 
	$test_output,
	$output,
	'Simple string with php tag truncated 4 characters'
);



/*  */
$test_input  = "<p>We're going to truncate this to one sentence! It should not show this one. Not this one.</p>";
$test_output = "<p>We're going to truncate this to one sentence!</p>";
     $output = subxml($test_input, 1, 'sentence');

compare(
	$test_input, 
	$test_output,
	$output,
	'String truncated to 1 sentence.'
);



$test_input  = "<p>But this is today. Badly formed. Sentences.</p>";
$test_output = '<p>But this is</p>';
     $output = subxml($test_input, 3, 'word');

compare(
	$test_input, 
	$test_output,
	$output,
	'Simple truncated to 3 words'
);
