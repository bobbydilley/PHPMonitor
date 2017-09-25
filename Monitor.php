<?php

echo "Monitoring program started\n";
// Wait time changes how many seconds should be waited before running another set of tests
$wait_time = 10;


$running = true;
while($running) {
	sleep($wait_time);
	echo "Monitored\n";
	
	# Monitor PI
	$time = date("h:i:sa");

	// Check status is used to run a script
	checkStatus("./input/check_pi_temp", "Raspberry Pi Temperature");
	checkStatus("./input/check_website_up", "Dilley.io website available");
}

/**
 * $path - The path to the script that will be run
 * $name - The name to give the script for messaging
 */
function checkStatus($path, $name) {
	$time = date("h:i:sa");
	$output = exec($path);
	$match = preg_match("/OKAY/", $output, $matches);
	if($match) {
		echo "[$time] [OKAY] " . $name . "\n";
	} else {
		echo "[$time] [FAIL] " . $name . "\n";
		echo "Reporting";
		runOutput("./output/notify_phone", $output);
	}
}

/**
 * $path - The path to the output script that will be run
 * $message - The message to alert with
 */
function runOutput($path, $message) {
	exec($path . " " . $message);
}
?>
