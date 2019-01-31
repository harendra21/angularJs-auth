<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function jsonResp($data){
	
	print_r(json_encode($data));
}