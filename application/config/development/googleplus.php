<?php
$config['googleplus']['application_name'] = 'Presente Top Login Test';#Use must have to use same application name which you register with google. Using APIs & Auth->Consent Screen
$config['googleplus']['client_id']        = '658798616529-r8440g2i1v1tnpeifrdjrs0ui1hgqlpd.apps.googleusercontent.com';
$config['googleplus']['client_secret']    = 'x6I4LRZC0ia3CDf7C0x17Q6w';
$config['googleplus']['redirect_uri']     = 'http://localhost/projects/presente-top/login/google-plus-redirect-url';#Add redirect url which you add in google console.
$config['googleplus']['api_key']          = 'AIzaSyC2ZIo7uVqKqJ1ABFlW9UvJnFWMsOuFh70';#Add Browser Key
$config['googleplus']['scopes']           = Array('https://www.googleapis.com/auth/plus.me', 'https://www.googleapis.com/auth/plus.login');
//,'https://www.googleapis.com/auth/plus.moments.write');
$config['googleplus']['actions'] = Array('http://schemas.google.com/AddActivity');
?>