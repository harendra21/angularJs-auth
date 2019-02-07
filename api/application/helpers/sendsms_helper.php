<?php 

function send_sms(){
	$fields = array(
	    "sender_id" => "FSTSMS",
	    "message" => "This is Test message",
	    "language" => "english",
	    "route" => "p",
	    "numbers" => "8948559862",
	    "flash" => "1"
	);

	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://www.fast2sms.com/dev/bulk",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => json_encode($fields),
	  CURLOPT_HTTPHEADER => array(
	    "authorization: 8EVIu9cnUgmQpKdzyNXvJtfRjGPrS63hk5DBlseLMTaAqCw204mhU1tgailA8c9BRW2oCGSFKVHnkNjz",
	    "accept: */*",
	    "cache-control: no-cache",
	    "content-type: application/json"
	  ),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
		$data = array('status' => 'error','msg' => $err);
	  	return $data;
	} else {
		$response = json_decode($response);
		if(!$response->return){
			$data = array('status' => 'error','msg' => $response->message);
	  		return $data;
		}else{
			$data = array('status' => 'success','msg' => $response->message);
	  		return $data;
		}
		
	  	
	  	
	}
}
