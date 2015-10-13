<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

$config['facebook']['api_id']       = '349895105208448';
$config['facebook']['app_secret']   = 'f1d89eadd576b9eb9557e5a8d94390e2';
$config['facebook']['redirect_url'] = base_url('/login/facebook_redirect_url');

$config['facebook']['permissions'] = array(
	'public_profile',
	'email',
	//'user_location',
	//'user_birthday',
);