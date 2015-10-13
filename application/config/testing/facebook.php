<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

$config['facebook']['api_id']       = '364638250400800';
$config['facebook']['app_secret']   = '39f38ddad842169a73543ca04fd9115d';
$config['facebook']['redirect_url'] = base_url('/login/facebook_redirect_url');

$config['facebook']['permissions'] = array(
	'public_profile',
	'email',
	//'user_location',
	//'user_birthday',
);