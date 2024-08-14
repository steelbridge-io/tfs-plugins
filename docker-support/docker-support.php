<?php
/**
	* Plugin Name: Docker Support
	* Plugin URI:  https://yourwebsite.com
	* Description: This plugin aims to fix PHP warnings/errors related to $_SERVER["HTTP_HOST"]
	* Version:     1.0
	* Author:      Your Name
	* Author URI:  https://yourwebsite.com
	*/

if (php_sapi_name() !== 'cli' && !isset($_SERVER['HTTP_HOST'])) {
	$_SERVER['HTTP_HOST'] = 'localhost';
}