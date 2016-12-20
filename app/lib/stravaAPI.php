<?php
class stravaAPI {
	private $client_id = STRAVA_CLIENT_ID;
	private $client_secret = STRAVA_CLIENT_SECRET;
//	private $client_code = 'd1dd6ed227892da878ce5f2f211b5ab2870ce551';
	
	private $auth_url = 'https://www.strava.com/oauth/authorize';
	private $access_token_url = 'https://www.strava.com/oauth/token';
	private $redirect_uri = '/integration/saveStrava';
	private $api_base_url = 'https://www.strava.com/api/v3/athlete/activities';
	private $api_conf_file = '';
	public $api_conf;
	public $api_created = false;
	public $api_last_error = null;
	public $access_token = null;
	public $token_type = 'Bearer';
	public $requestRedirectUrl = null;
	public $api_request_log = null;
	
	/*
	 * 
	 */
	public function __construct() {
		$this->api_created = true;
	}
	
	/*
	 * 
	 */
	private function server_url() {
		if (isset ( $_SERVER ['HTTPS'] )) {
			$protocol = ($_SERVER ['HTTPS'] && $_SERVER ['HTTPS'] != "off") ? "https" : "http";
		} else {
			$protocol = 'http';
		}
		return $protocol . "://" . $_SERVER ['HTTP_HOST'];
	}
	
	/*
	 * 
	 */
	public function connectStravaButtonUrl() {
		$url = $this->auth_url . '?response_type=code&client_id=' . $this->client_id . '&redirect_uri=' . urlencode ( $this->server_url () . $this->redirect_uri ) . '&scope=write&state=mystate&approval_prompt=force';
		return ($url);
	}
	
	/*
	 * 
	 */
	public function getStravaToken($authorization_code, $redirect_uri = '') {
		$params = http_build_query ( array (
				'grant_type' => 'authorization_code',
				'code' => $authorization_code,
				'client_id' => $this->client_id,
				'client_secret' => $this->client_secret,
				'redirect_uri' => ($redirect_uri == '' ? ($this->server_url () . $this->redirect_uri) : $redirecturi) 
		) );
		$options = array (
				CURLOPT_URL => $this->access_token_url,
				CURLOPT_POST => true,
				CURLOPT_POSTFIELDS => $params,
				CURLOPT_RETURNTRANSFER => true 
		);
		$curl = curl_init ();
		curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, false ); /* Added to avoid "error :SSL certificate problem, verify that the CA cert is OK" */
		curl_setopt_array ( $curl, $options );
		$response = curl_exec ( $curl );
		curl_close ( $curl );
		$decoderesponse = json_decode ( $response );
		if ($decoderesponse == null) {
			$this->api_last_error = "getStravaToken: bad response";
			return (false);
		} elseif (! isset ( $decoderesponse->error )) {
			if ($decoderesponse->access_token) {
				$this->access_token = $decoderesponse->access_token;
			}
			if ($decoderesponse->token_type) {
				$this->token_type = $decoderesponse->token_type;
			}
			return (true);
		} elseif ($decoderesponse->error == 'invalid_grant') {
			header ( 'Location: ' . $this->auth_url . '?response_type=code&client_id=' . $this->client_id . '&redirect_uri=' . urlencode ( $this->server_url () . $this->redirect_uri ), true, 302 );
			exit ();
		} else {
			$this->api_last_error = "getStravaToken: " . $decoderesponse->error;
			return (false);
		}
	}
	
	/*
	 * 
	 */
	public function setStravaToken($access_token) {
		$this->access_token = $access_token;
	}
	
	/*
	 * 
	 */
	public function doStavaRequest($name, $type, $fields = null, $url = null, $optparams = null) {
	}
	
	/*
	 * 
	 */
	private function parseHeader($curl, $header) {
		if (strstr ( $header, 'Location: ' ))
			$this->requestRedirectUrl = substr ( $header, 10, strlen ( $header ) - 12 );
		return strlen ( $header );
	}
	
	/*
	 * 
	 */
	public function getLastActivity() {
		$curl = curl_init ();
		
		curl_setopt_array ( $curl, array (
				CURLOPT_URL => "https://www.strava.com/api/v3/athlete/activities",
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 30,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "GET",
				CURLOPT_HTTPHEADER => array (
						"authorization: Bearer " . $this->access_token,
						"cache-control: no-cache",
						"per_page: 1" 
				) 
		) );
		
		$response = curl_exec ( $curl );
		$err = curl_error ( $curl );
		
		curl_close ( $curl );
		
		return json_decode ( $response, true );
	}

	/*
	 * 
	 */
	public function getAllActivities() {
		$curl = curl_init ();
		
		curl_setopt_array ( $curl, array (
				CURLOPT_URL => "https://www.strava.com/api/v3/athlete/activities",
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 30,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "GET",
				CURLOPT_HTTPHEADER => array (
						"authorization: Bearer " . $this->access_token,
						"cache-control: no-cache",
						"per_page: 99" 
				) 
		) );
		
		$response = curl_exec ( $curl );
		$err = curl_error ( $curl );
		
		curl_close ( $curl );
		
		return json_decode ( $response, true );
	}

}
