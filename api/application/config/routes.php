<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//$route['default_controller'] = 'HomeCtrl';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['auth/login'] = 'auth/AuthCtrl/login';

$route['auth/loginUserDetails'] = 'auth/AuthCtrl/loginUserDetails';

$route['history/getFrontHistory'] = 'history/HistoryCtrl/getFrontHistory';

$route['fileupload'] = 'HomeCtrl/fileUpload';

$route['profile/updateProfile'] = 'profile/profileCtrl/updateProfile';

$route['send-sms'] = 'profile/profileCtrl/send_sms';

$route['dir'] = 'profile/profileCtrl/dir';


$route['category/get-category'] = 'category/categoryCtrl/getCategory';

$route['category/addeditCategory'] = 'category/categoryCtrl/addeditCategory';


$route['speaker/get-speaker'] = 'speaker/speakerCtrl/getSpeaker';

$route['speaker/addeditSpeaker'] = 'speaker/speakerCtrl/addeditSpeaker';