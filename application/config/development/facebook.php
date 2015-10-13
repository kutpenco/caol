<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

$config['facebook']['api_id']       = '350531311811494';
$config['facebook']['app_secret']   = '284590a64515e3900c0ff1f9d2f399f6';
$config['facebook']['redirect_url'] = base_url('/login/facebook_redirect_url');

$config['facebook']['permissions'] = array(
	'public_profile',
	'email',
	//'user_location',
	//'user_birthday',
);