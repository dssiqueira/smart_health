<?php

// Identify protocol
$protocol = null;
if (isset ( $_SERVER ['HTTPS'] )) {
	$protocol = ($_SERVER ['HTTPS'] && $_SERVER ['HTTPS'] != "off") ? "https://" : "http://";
} else {
	$protocol = 'http://';
}

define ( 'URL_PUBLIC_FOLDER', 'public' );
define ( 'URL_PROTOCOL', $protocol );
define ( 'URL_DOMAIN', $_SERVER ['HTTP_HOST'] );
define ( 'URL_SUB_FOLDER', str_replace ( URL_PUBLIC_FOLDER, '', dirname ( $_SERVER ['SCRIPT_NAME'] ) ) );
define ( 'URL', URL_PROTOCOL . URL_DOMAIN . URL_SUB_FOLDER );

// Identify environment
$environment = null;
if (URL_DOMAIN == 'localhost') {
	$environment = 'local';
} else if (URL_DOMAIN == 'ssl-310157.uni5.net') { // TODO: hardcoded
	$environment = 'stage';
} else {
	$environment = 'production';
}

define ( 'ENVIRONMENT', $environment );

// Locally allow DEBUG
if (ENVIRONMENT == 'local') {
	error_reporting ( E_ALL );
	ini_set ( "display_errors", 1 );
}

/**
 * Configuration for: Database
 */
if (ENVIRONMENT == 'local') {
	define ( 'DB_TYPE', 'mysql' );
	define ( 'DB_HOST', 'localhost:3306' );
	define ( 'DB_NAME', 'smart_health' );
	define ( 'DB_USER', 'root' );
	define ( 'DB_PASS', 'root' );
	define ( 'DB_CHARSET', 'utf8' );
} else if (ENVIRONMENT == 'stage') {
	define ( 'DB_TYPE', 'mysql' );
	define ( 'DB_HOST', 'mysql.comovejoomundo.com.br' );
	define ( 'DB_NAME', 'comovejoomundo07' );
	define ( 'DB_USER', 'comovejoomundo07' );
	define ( 'DB_PASS', '' );
	define ( 'DB_CHARSET', 'utf8' );
} else {
	// production database;
}


/*
 * Configuration for: APIs
 */
define ( 'RUNKEEPER_CLIENT_ID', '8ca1c685ee4a4ad88ffcddfe24f3d0cf' );
define ( 'RUNKEEPER_CLIENT_SECRET', 'b82055792ae344aea00f5dc3c176727a' );

define ( 'STRAVA_CLIENT_ID', '11678' );
define ( 'STRAVA_CLIENT_SECRET', '8a0948c4b088f47697c44f206c343a4cf598341b' );


/*
 * Configuration for: SMART CANVAS
 */

define ( 'SMARTCANVAS_PROFILE_URL', 'https://ciandt.smartcanvas.com/f/persons/' );

