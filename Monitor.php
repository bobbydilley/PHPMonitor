<?php

echo "Monitoring program started\n";
$wait_time = 10;
$running = true;
while($running) {
	sleep($wait_time);
	echo "Monitored\n";
	
	# Monitor PI
	$time = date("h:i:sa");
	checkStatus("./input/check_pi_temp", "Raspberry Pi Temperature");
	checkStatus("./input/check_website_up", "Dilley.io website available");
}

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

function runOutput($path, $message) {
	exec($path . " " . $message);
}
?>
