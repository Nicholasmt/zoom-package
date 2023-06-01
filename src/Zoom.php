<?php 
 
 namespace Nicholasmt\ZoomLibrary;
 
//Include Firebase Library and Dependencies
require_once 'php-jwt-master/src/BeforeValidException.php';
require_once 'php-jwt-master/src/ExpiredException.php';
require_once 'php-jwt-master/src/SignatureInvalidException.php';
require_once 'php-jwt-master/src/JWT.php';

use \Firebase\JWT\JWT;


class Zoom
{
	private $zoom_api_key = 'kd-byVJETwyNw8ri4Tr0Cw';
	private $zoom_api_secret = 'tUUjbl27weXxmoDcD7CHywfKzVF6cRR3PS9k';	
  
    //function to generate Token
	private function generateToken() 
	{
		$key = $this->zoom_api_key;

		$secret = $this->zoom_api_secret;
		 $token = array(
		 	"iss" => $key,
		 	"exp" => time() + 3600 //60 seconds as suggested
		);

		    // $account_ID = "vQ9jdIL0RB-LpdysKZOmYw";
			// $client_ID =  'xK8i2MNFQm28PZOcsNXimQ';
			// $client_secret = 'fhfv3yTn3Mg0Ae9qu7po7uWKHWCpUa7q';
			$scope = array('meeting:write:admin',
			               'meeting:write'
	                      );

			$account_ID	    = env('ACCOUNT_ID');
			$client_ID	    = env('CLIENT_ID');
			$client_secret	= env('CLIENT_SECRET');
		 
		    
			$url = "https://zoom.us/oauth/token?grant_type=account_credentials&account_id=" . $account_ID;
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POST, TRUE);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(        
				'grant_type'    => 'client_credentials',    # https://www.oauth.com/oauth2-servers/access-tokens/client-credentials/        
				'scope'         =>$scope,  
			)));

			$headers[] = "Authorization: Basic " . base64_encode($client_ID . ":" . $client_secret);
			$headers[] = "Content-Type: application/x-www-form-urlencoded";
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			$data = curl_exec($ch);
			$auth = json_decode($data, true);
		    $access_token = $auth['access_token'];
			 
             // for JWT
			// return JWT::encode($access_token, $secret);
			
			// for OAuth  access token
			return $access_token;

	}	
	
	//function to create meeting
     public function createMeeting($data = array())
    {
		$post_time  = $data['start_date'];
		$start_time = gmdate("Y-m-d\TH:i:s", strtotime($post_time));

		$createMeetingArray = array();
		if (!empty($data['alternative_host_ids'])) {
		    if (count($data['alternative_host_ids']) > 1) {
			$alternative_host_ids = implode(",", $data['alternative_host_ids']);
		    } else {
			$alternative_host_ids = $data['alternative_host_ids'][0];
		    }
		}


		$createMeetingArray['topic']      = $data['topic'];
		$createMeetingArray['agenda']     = !empty($data['agenda']) ? $data['agenda'] : "";
		$createMeetingArray['type']       = !empty($data['type']) ? $data['type'] : 2; //Scheduled
		$createMeetingArray['start_time'] = $start_time;
		$createMeetingArray['timezone']   = 'Africa/Lagos';
		$createMeetingArray['password']   = !empty($data['password']) ? $data['password'] : "";
		$createMeetingArray['duration']   = !empty($data['duration']) ? $data['duration'] : 60;

		$createMeetingArray['settings']   = array(
            		'join_before_host'  => !empty($data['join_before_host']) ? true : false,
            		'host_video'        => !empty($data['option_host_video']) ? true : false,
            		'participant_video' => !empty($data['option_participants_video']) ? true : false,
            		'mute_upon_entry'   => !empty($data['option_mute_participants']) ? true : false,
            		'enforce_login'     => !empty($data['option_enforce_login']) ? true : false,
            		'auto_recording'    => !empty($data['option_auto_recording']) ? $data['option_auto_recording'] : "none",
            		'alternative_hosts' => isset($alternative_host_ids) ? $alternative_host_ids : ""
        	);

		return $this->sendRequest($createMeetingArray);
	}	
	
	//function to send request
    protected function sendRequest($data)
    {
		$request_url = "https://api.zoom.us/v2/users/me/meetings";
	    $headers = array(
			"authorization: Bearer ".$this->generateToken(),
			 "content-type: application/json",
			"Accept: application/json",
		);
		
		$postFields = json_encode($data);
		
        	$ch = curl_init();
        	curl_setopt_array($ch, array(
            CURLOPT_URL => $request_url,
	    	CURLOPT_RETURNTRANSFER => true,
	    	CURLOPT_ENCODING => "",
	    	CURLOPT_MAXREDIRS => 10,
	    	CURLOPT_TIMEOUT => 30,
	    	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	    	CURLOPT_CUSTOMREQUEST => "POST",
	    	CURLOPT_POSTFIELDS => $postFields,
	    	CURLOPT_HTTPHEADER => $headers,
		 
        	));

        	$response = curl_exec($ch);
        	$err = curl_error($ch);
        	curl_close($ch);
        	if (!$response) 
			{
              return $err;
		    }
        	return json_decode($response);
	}

	public function update_meeting($meeting_id,$data = array())
    {
		 $request_url = "https://api.zoom.us/v2/meetings/".$meeting_id."/status";
		 $update_body =  json_encode($data);
		 $headers = array(
			"authorization: Bearer ".$this->generateToken(),
			 "content-type: application/json",
			"Accept: application/json",
		);
		   $ch = curl_init();
        	curl_setopt_array($ch, array(
            CURLOPT_URL => $request_url,
	    	CURLOPT_RETURNTRANSFER => true,
	    	CURLOPT_ENCODING => "",
	    	CURLOPT_MAXREDIRS => 10,
	    	CURLOPT_TIMEOUT => 30,
	    	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	    	CURLOPT_CUSTOMREQUEST => "PUT",
			CURLOPT_POSTFIELDS => $update_body,
	    	CURLOPT_HTTPHEADER => $headers,
		 
        	));
           $response = curl_exec($ch);
        	$err = curl_error($ch);
        	curl_close($ch);
        	if (!$response) 
			{
              return $err;
		    }
			// return response()->json($response);
        	return json_decode($response);

	}

	
}