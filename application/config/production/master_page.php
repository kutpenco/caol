<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

/*
| -------------------------------------------------------------------
| MASTER PAGE TEMPLATE SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings for the master page functions.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['page_title'] App title.
|	['header'] Path to header view.
|   ['header_vars'] Header variables passed to header view.
|	['footer'] Path to footer view.
|   ['footer_vars'] Footer variables passed to footer view.
|	['mobile_prefix'] Prefix path to be applied to views loaded from mobile user agents.
 */

$config['page_title'] = "Presente Top";
$config['header'] = "/shared/view_header";
$config['header_vars'] = array();
$config['footer'] = "/shared/view_footer";
$config['footer_vars'] = array();
$config['mobile_prefix'] = "";
$config['mobile_enabled'] = TRUE;