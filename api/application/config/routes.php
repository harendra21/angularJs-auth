<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'HomeCtrl';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['auth/login'] = 'auth/AuthCtrl/login';

$route['auth/loginUserDetails'] = 'auth/AuthCtrl/loginUserDetails';

$route['history/getFrontHistory'] = 'history/HistoryCtrl/getFrontHistory';