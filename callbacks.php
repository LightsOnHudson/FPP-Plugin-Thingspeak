#!/usr/bin/php
<?
//error_reporting(0);

$skipJSsettings = 1;
include_once '/opt/fpp/www/config.php';
include_once '/opt/fpp/www/common.php';

include_once "functions.inc.php";


define('LOCK_DIR', '/tmp/');
define('LOCK_SUFFIX', '.lock');
$pluginName = "Thingspeak";


$myPid = getmypid();

//arg0 is  the program
//arg1 is the first argument in the registration this will be --list
//$DEBUG=true;
$logFile = $settings['logDirectory']."/".$pluginName.".log";



//	Hostname on DuckDNS
$DNS_HOSTNAME = urldecode($pluginSettings['DNS_HOSTNAME']);
//	$ENABLED = urldecode(ReadSettingFromFile("ENABLED",$pluginName));

$API_TOKEN = urldecode($pluginSettings["API_TOKEN"]);
$DEBUG = urldecode($pluginSettings['DEBUG']);



$ENABLED = $pluginSettings['ENABLED'];



$ENABLED="";


if(trim(strtoupper($ENABLED)) != "ON" || $ENABLED != "1" ) {
	logEntry("Plugin Status: DISABLED Please enable in Plugin Setup to use & Restart FPPD Daemon");

	exit(0);
}


//none at this time
$callbackRegisters = "media";
//$callbackRegisters = "playlist,media";
//var_dump($argv);

$FPPD_COMMAND = $argv[1];

//echo "FPPD Command: ".$FPPD_COMMAND."<br/> \n";

if($FPPD_COMMAND == "--list") {

	echo $callbackRegisters;
	logEntry("FPPD List Registration request: responded:". $callbackRegisters);
	exit(0);
}

if($FPPD_COMMAND == "--type") {
	logEntry("type callback requested");
	//we got a register request message from the daemon
	processCallback($argv);
	exit(0);
}

logEntry($argv[0]." called with no parameteres");
exit(0);

?>
