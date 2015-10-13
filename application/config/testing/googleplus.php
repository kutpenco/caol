<?php
$config['googleplus']['application_name'] = 'Presente Top Login Test';#Use must have to use same application name which you register with google. Using APIs & Auth->Consent Screen
$config['googleplus']['client_id']        = '658798616529-09aqodst43rp32l8a6257kenip79ccun.apps.googleusercontent.com';
$config['googleplus']['client_secret']    = 'rsTbWsutyHIertyId-uaUPb9';
$config['googleplus']['redirect_uri']     = 'http://www.betadevconsult.com.br/projects/presente-top/login/google-plus-redirect-url';#Add redirect url which you add in google console.
$config['googleplus']['api_key']          = 'AIzaSyBSmsEMRoDaryviciGEa4FWYp9HaUcyurY';#Add Browser Key
$config['googleplus']['scopes']           = Array('https://www.googleapis.com/auth/plus.me', 'https://www.googleapis.com/auth/plus.login');
//,'https://www.googleapis.com/auth/plus.moments.write');
$config['googleplus']['actions'] = Array('http://schemas.google.com/AddActivity');
?>