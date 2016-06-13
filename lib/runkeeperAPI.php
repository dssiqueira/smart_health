<?php

class runkeeperAPI {
	private $client_id = '8ca1c685ee4a4ad88ffcddfe24f3d0cf';
	private $client_secret = 'b82055792ae344aea00f5dc3c176727a';
	private $auth_url = 'https://runkeeper.com/apps/authorize';
	private $access_token_url = 'https://runkeeper.com/apps/token';
	private $redirect_uri = '/saveRKIntegration.php';
	private $api_base_url = 'https://api.runkeeper.com';
	private $api_conf_file = '';
	public $api_conf;
	public $api_created = false;
	public $api_last_error = null;
	public $access_token = null;
	public $token_type = 'Bearer';
	public $requestRedirectUrl = null;
	public $api_request_log = null;

	public function __construct() {
		$this->api_created = true;
	}

	private function server_url(){
	    if(isset($_SERVER['HTTPS'])){
		$protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
	    }
	    else{
		$protocol = 'http';
	    }
	    return $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	}

	public function connectRunkeeperButtonUrl () {
		$url = $this->auth_url.'?response_type=code&client_id='.$this->client_id.'&redirect_uri='.urlencode($this->server_url() . $this->redirect_uri);
		return($url);
	}

	public function getRunkeeperToken ($authorization_code, $redirect_uri='') {
		$params = http_build_query(array(
			'grant_type'	=>	'authorization_code',
			'code'		=>	$authorization_code,
			'client_id'	=>	$this->client_id,
			'client_secret'	=>	$this->client_secret,
			'redirect_uri'	=>	($redirect_uri == '' ? ($this->server_url() . $this->redirect_uri) : $redirecturi)
		));
		$options = array(
			CURLOPT_URL		=>	$this->access_token_url,
			CURLOPT_POST		=>	true,
			CURLOPT_POSTFIELDS	=>	$params,
			CURLOPT_RETURNTRANSFER	=>	true
		);
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); /* Added to avoid "error :SSL certificate problem, verify that the CA cert is OK" */
		curl_setopt_array($curl, $options);
		$response     = curl_exec($curl);
		curl_close($curl);
		$decoderesponse = json_decode($response);
		if ($decoderesponse == null) {
			$this->api_last_error = "getRunkeeperToken: bad response";
			return(false);
		}
		elseif (!isset($decoderesponse->error)){
			if ($decoderesponse->access_token) {
				$this->access_token = $decoderesponse->access_token;
			}
			if ($decoderesponse->token_type) {
				$this->token_type = $decoderesponse->token_type;
			}
			return(true);
		}
		elseif ($decoderesponse->error == 'invalid_grant') {
			header('Location: '.$this->auth_url.'?response_type=code&client_id='.$this->client_id.'&redirect_uri='.urlencode($this->server_url() . $this->redirect_uri), true, 302);
			exit();
		}
		else {
			$this->api_last_error = "getRunkeeperToken: ".$decoderesponse->error;
			return(false);
			
		}
	}

	public function setRunkeeperToken ($access_token) {
		$this->access_token = $access_token;
	}

	public function doRunkeeperRequest($name, $type, $fields=null, $url=null, $optparams=null) {
		$this->requestRedirectUrl = null;
		$orig = microtime(true);
		if (!$name || !$this->api_conf->Interfaces->$name) {
			$this->api_last_error = "doRunkeeperRequest: wrong or missing Interface name";
			return(false);
		}
		elseif (!$type || !$this->api_conf->Interfaces->$name->$type) {
			$this->api_last_error = "doRunkeeperRequest: not supported or missing type (Read, Update, Create or Delete)";
			return(false);
		}
		else {
			switch($this->api_conf->Interfaces->$name->$type->Method) {
				case 'GET':
					$params = ($optparams == null ? '' : '?'.http_build_query($optparams));
					$options = array(
						CURLOPT_HTTPHEADER	=>	array(
							'Authorization: '.$this->token_type.' '.$this->access_token,
							'Accept: '.$this->api_conf->Interfaces->$name->Media_Type
							),
						CURLOPT_URL		=>	($url == null ? $this->api_base_url.$this->api_conf->Interfaces->$name->$type->Url : (strstr($url,'http://') || strstr($url,'https://') ? $url : $this->api_base_url.$url)).$params,
						CURLOPT_RETURNTRANSFER	=>	true,
						CURLINFO_HEADER_OUT	=>	true,
					);
					break;
				case 'POST':
					$params = ($optparams == null ? '' : '?'.http_build_query($optparams));
					$jsonfields = json_encode($fields);
					$options = array(
						CURLOPT_HTTPHEADER	=>	array(
							'Authorization: '.$this->token_type.' '.$this->access_token,
							'Content-Type: '.$this->api_conf->Interfaces->$name->Media_Type,
							'Content-Length: '.strlen($jsonfields)
							),
						CURLOPT_FOLLOWLOCATION	=>	false,
						CURLOPT_URL		=>	($url == null ? $this->api_base_url.$this->api_conf->Interfaces->$name->$type->Url : (strstr($url,'http://') || strstr($url,'https://') ? $url : $this->api_base_url.$url)).$params,
						CURLOPT_RETURNTRANSFER	=>	true,
						CURLINFO_HEADER_OUT	=>	true,
						CURLOPT_CUSTOMREQUEST	=>	'POST',
						CURLOPT_POSTFIELDS	=>	$jsonfields
					);
					break;
				case 'PUT':
					$params = ($optparams == null ? '' : '?'.http_build_query($optparams));
					$jsonfields = json_encode($fields);
					$options = array(
						CURLOPT_HTTPHEADER	=>	array(
							'Authorization: '.$this->token_type.' '.$this->access_token,
							'Content-Type: '.$this->api_conf->Interfaces->$name->Media_Type,
							'Content-Length: '.strlen($jsonfields)
							),
						CURLOPT_FOLLOWLOCATION	=>	false,
						CURLOPT_URL		=>	($url == null ? $this->api_base_url.$this->api_conf->Interfaces->$name->$type->Url : (strstr($url,'http://') || strstr($url,'https://') ? $url : $this->api_base_url.$url)).$params,
						CURLOPT_RETURNTRANSFER	=>	true,
						CURLINFO_HEADER_OUT	=>	true,
						CURLOPT_CUSTOMREQUEST	=>	'PUT',
						CURLOPT_POSTFIELDS	=>	$jsonfields
					);
					break;
				case 'DELETE':
					$options = array(
						CURLOPT_HTTPHEADER	=>	array(
							'Authorization: '.$this->token_type.' '.$this->access_token,
							'Content-Type: '.$this->api_conf->Interfaces->$name->Media_Type,
							'Content-Length: 0'
							),
						CURLOPT_FOLLOWLOCATION	=>	false,
						CURLOPT_URL		=>	($url == null ? $this->api_base_url.$this->api_conf->Interfaces->$name->$type->Url : (strstr($url,'http://') || strstr($url,'https://') ? $url : $this->api_base_url.$url)).$params,
						CURLOPT_RETURNTRANSFER	=>	true,
						CURLINFO_HEADER_OUT	=>	true,
						CURLOPT_CUSTOMREQUEST	=>	'PUT'
					);

					break;
			}
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); /* Added to avoid "error :SSL certificate problem, verify that the CA cert is OK" */
			curl_setopt_array($curl, $options);
			curl_setopt($curl, CURLOPT_HEADERFUNCTION, array(&$this,'parseHeader')); /* add callback header function to process response headers */
			$response     = curl_exec($curl);
			$responsecode = curl_getinfo($curl,CURLINFO_HTTP_CODE);
			curl_close($curl);
			if ($this->requestRedirectUrl != null) {
				/* After creating new activity/measurement : get a Location header with url to retreive created activity/measurment */
				$parentName = (!property_exists($this->api_conf->Interfaces->$name,'Parent') ? $this->api_conf->Interfaces->$name->Name : $this->api_conf->Interfaces->$name->Parent);
				$this->api_request_log[] = array('name' => $name, 'type' => $type, 'result' => 'redir', 'time' => microtime(true)-$orig);
				return $this->doRunkeeperRequest($parentName,'Read',$fields,$this->requestRedirectUrl,$optparams);
			}
			else {
				if ($responsecode === 200) {
					$response = htmlentities($response,ENT_NOQUOTES);
					$decoderesponse = json_decode($response);
					$this->api_request_log[] = array('name' => $name, 'type' => $type, 'result' => 200, 'time' => microtime(true)-$orig);
					return($decoderesponse);
				}

				elseif (in_array($responsecode, array('201','204','301','304'))) {
					$this->api_request_log[] = array('name' => $name, 'type' => $type, 'result' => $responsecoce, 'time' => microtime(true)-$orig);
					return true;
				}
				else {
					$this->api_last_error = "doRunkeeperRequest: request error => 'name' : ".$name.", 'type' : ".$type.", 'result' : ".$responsecode.", '".$name."' => ".$url;
					$this->api_request_log[] = array('name' => $name, 'type' => $type, 'result' => 'error : '.$responsecode, 'time' => microtime(true)-$orig);
					return false;
				}
			}
		}
	}

	private function parseHeader ($curl,$header) {
		if (strstr($header,'Location: '))
			$this->requestRedirectUrl = substr($header, 10, strlen($header)-12);
		return strlen($header);
	}
	
	public function getLastActivity()
	{
		$curl = curl_init();
		
		curl_setopt_array($curl, array(
				CURLOPT_URL => "http://api.runkeeper.com/fitnessActivities?pageSize=1",
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 30,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "GET",
				CURLOPT_HTTPHEADER => array(
						"accept: application/vnd.com.runkeeper.FitnessActivityFeed+json",
						"authorization: Bearer ". $this->access_token,
						"cache-control: no-cache"
				),
		));
		
		$response = curl_exec($curl);
		$err = curl_error($curl);
		
		curl_close($curl);
				
		return json_decode($response, true);
		
	}
	
}
