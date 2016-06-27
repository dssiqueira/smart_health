<?php

/**
 * Class SaveIntegration
 */
class Integration extends Controller {
	
	/*
	 * 
	 */
	public function index() {
		// should be a method here
	}
	
	/*
	 * 
	 */
	public function saveStrava() {
		if (! isset ( $_SESSION [SESSION_NAME] )) {
			header ( 'location: ' . URL . 'error?error=SAVE_INTEGRATION_AUTH_ERROR' );
		}
		
		// Recover User from Session
		$user_token = $_SESSION [SESSION_NAME];
		// Load User
		require_once APP . 'models/userModel.php';
		$userModel = new UserModel ( $this->db );
		
		$user = $userModel->getUserByToken ( $user_token );
		
		if (isset ( $user->id )) {
			$uid = $user->id;
		} else {
			// Something went wrong here
			header ( 'location: ' . URL . 'error?error=SAVE_INTEGRATION_AUTH_ERROR' );
		}
		
		// Load Strava API
		require_once APP . 'lib/stravaAPI.php';
		
		$stravaAPI = new stravaAPI ();
		
		require_once APP . 'models/integrationModel.php';
		$integrationModel = new IntegrationModel ( $this->db );
		
		if ($_GET ['code']) {
			$auth_code = $_GET ['code'];
			
			if ($stravaAPI->getStravaToken ( $auth_code ) == false) {
				header ( 'location: ' . URL . 'error?error=SAVE_INTEGRATION_TOKEN_ERROR' );
			} else {
				// Save/Update Integration
				$integrationModel->insertIntegration ( STRAVA_ID, $uid, $stravaAPI->access_token );
				
				$integration = $integrationModel->getIntegrationByUserIdAndAppId ( $uid, STRAVA_ID );
				
				// Add last Activity just for test
				$stravaActivities = $stravaAPI->getLastActivity ();
				
				require_once APP . 'models/activityModel.php';
				$activitiesModel = new ActivityModel ( $this->db );
				
				$activitiesModel->insertActivity ( 
						$integration->id, 
						strtotime ( $stravaActivities [0] ['start_date_local'] ), 
						$stravaActivities [0] ['type'], 
						$stravaActivities [0] ['distance'], 
						'0' ); // no calories for Stravia =(
			}
		}
		header ( 'location: ' . URL . 'home?connect=Strava' );
	}
	
	/*
	 * 
	 */
	public function saveRunkeeper() {
		
		// Check Authentication
		$user_token = isset ( $_SESSION [SESSION_NAME] ) ? $_SESSION [SESSION_NAME] : null;
		if (is_null ( $user_token )) {
			header ( 'location: ' . URL . 'error?error=SAVE_INTEGRATION_AUTH_ERROR' );
		}
		
		// Check return from Runkeeper
		$auth_code = isset ( $_GET ['code'] ) ? $_GET ['code'] : null;
		if (empty ( $auth_code )) {
			header ( 'location: ' . URL . 'error?error=SAVE_INTEGRATION_RK_CODE_IS_NULL' );
		}
		
		// Load User
		require_once APP . 'models/userModel.php';
		$userModel = new UserModel ( $this->db );
		$user = $userModel->getUserByToken ( $user_token );
		
		if (! is_null ( $user->id )) {
			$uid = $user->id;
		} else {
			// Something went wrong here
			header ( 'location: ' . URL . 'error?error=SAVE_INTEGRATION_AUTH_ERROR' );
		}
		
		// Load Runkeeper API
		require_once APP . 'lib/runkeeperAPI.php';
		$rkAPI = new runkeeperAPI ();
		
		if ($rkAPI->getRunkeeperToken ( $auth_code ) == false) {
			header ( 'location: ' . URL . 'error?error=SAVE_INTEGRATION_TOKEN_ERROR' );
		} else {
			
			require_once APP . 'models/integrationModel.php';
			$integrationModel = new IntegrationModel ( $this->db );
			// Save / Update integration
			$integrationModel->insertIntegration ( RUNKEEPER_ID, $uid, $rkAPI->access_token );
			
			$integration = $integrationModel->getIntegrationByUserIdAndAppId ( $uid, RUNKEEPER_ID );
			
			// Add last Activity just for test
			$rkActivities = $rkAPI->getLastActivity ();
			
			require_once APP . 'models/activityModel.php';
			$activitiesModel = new ActivityModel ( $this->db );
			
			$activitiesModel->insertActivity ( 
					$integration->id, 
					strtotime ( $rkActivities ['items'] [0] ['start_time'] ), 
					$rkActivities ['items'] [0] ['type'], 
					$rkActivities ['items'] [0] ['total_distance'], 
					$rkActivities ['items'] [0] ['total_calories'] );
		}
		header ( 'location: ' . URL . 'home?connect=Runkeeper' );
	}
	
	/*
	 * 
	 */
	public function disconnect() {
		$user_token = $_SESSION [SESSION_NAME];
		$appid = isset ( $_POST ['appid'] ) ? $_POST ['appid'] : null;
		
		if (empty ( $appid ) || empty ( $user_token )) {
			header ( 'location: ' . URL . 'home?disconnect=false' );
		}
		
		require_once APP . 'models/userModel.php';
		$userModel = new UserModel ( $this->db );
		
		$uid = $userModel->getUserByToken ( $user_token );
		
		require_once APP . 'models/integrationModel.php';
		$integrationModel = new IntegrationModel ( $this->db );
		
		$integrationModel->delete ( $uid->id, $appid );
		
		header ( 'location: ' . URL . 'home?disconnect=true' );
	}
}
