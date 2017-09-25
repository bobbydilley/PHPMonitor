# Monitor
Monitor program for logging and creating automation

## Inputs

All scripts that check a service should be placed into the Inputs folder. They should either echo the word "OKAY" or "FAIL" to the console depending on if the script passed or failed.

Currently if a script fails, it will simply use the only output script to text a phone using IFTTT's integration.

## Outputs

All scripts that message or notify a service should be placed into the Outputs folder.

These should be called only with 1 argument, which is the message that should be sent.

## Monitor.php

The monitor.php script runs the base for checking inputs and notifying outputs, each time a new input or output is added it needs to be configured with code in the monitor.php script.

The script will only run once, and so should be added to a cronjob.

## Future

Although the simple nature of the project will be kept, json files will be used to setup the system so that monitor.php doesn't have to be changed.
