<?php

/**
 * Admin Controller
 *
 */
class Admin extends Controller {
	
	public $authUser = null;
	public $userModel = null;
	private $include_html = null;
	
	/*
	 * 
	 * Default Admin Page
	 * 
	 */
	public function index() {
		$this->isAdmin ();
		
		$user = $this->authUser;
		
		require APP . 'view/_templates/home-header.php';
		require APP . 'view/admin.php';
		require APP . 'view/_templates/home-footer.php';
	}
	
	/*
	 * 
	 * Page to run the refresh job
	 * 
	 */
	public function runJob() {
		$this->isAdmin ();
		
		$user = $this->authUser;
		
		// HEADER
		require APP . 'view/_templates/home-header.php';
		require APP . 'view/admin.php';
		
		// CONTENT
		$users = $this->userModel->getAllUsers ();
		
		require_once APP . 'models/activityModel.php';
		$activityModel = new ActivityModel ( $this->db );

		require_once APP . 'models/integrationModel.php';
		$integrationModel = new IntegrationModel ( $this->db );
		
		// Load Strava API
		require_once APP . 'lib/stravaAPI.php';
		$stravaAPI = new stravaAPI ();
		
		
		// Load Runkeeper API
		require_once APP . 'lib/runkeeperAPI.php';
		$rkAPI = new runkeeperAPI ();
		
		
		// For each user
		foreach ( $users as $singleUser ) {
			$integrations = $integrationModel->getAllIntegrationsByUserId($singleUser->id);

			print '<br/>Name: ' . $singleUser->name . '  Created at: ' . $singleUser->created_at . '  ' . '  Deleted? ' . $singleUser->deleted . '</br>';
				
			// And each integration of this user
			foreach ($integrations as $integration) {
				if ($integration->app_id == STRAVA_ID) {
					// Save Last activity for Strava
					$stravaAPI->setStravaToken ( $integration->token );
					$stravaActivities = $stravaAPI->getLastActivity ();
										
					$retAct = $activityModel->insertActivity ( 
							$integration->id, 
							strtotime ( $stravaActivities [0] ['start_date_local'] ), 
							$stravaActivities [0] ['type'], 
							$stravaActivities [0] ['distance'], 
							'0' ); // no calories for Stravia =(
					
					if ($retAct) {
						print '    Strava activity updated - ' . $stravaActivities [0] ['start_date_local'] . '</br>';
					} else {
						print '    Strava activity already updated </br>';
					}
								
				} elseif ($integration->app_id == RUNKEEPER_ID) {
					// Save Last activity for Runkeeper
					$rkAPI->setRunkeeperToken ( $integration->token );
					$rkActivities = $rkAPI->getLastActivity ();
											
					$retAct = $activityModel->insertActivity (
							$integration->id,
							strtotime ( $rkActivities ['items'] [0] ['start_time'] ),
							$rkActivities ['items'] [0] ['type'],
							$rkActivities ['items'] [0] ['total_distance'],
							$rkActivities ['items'] [0] ['total_calories'] );
					
					if ($retAct) {
						print '    Runkeeper activity updated - ' . $rkActivities ['items'] [0] ['start_time'] . '</br>';
					} else {
						print '    Runkeeper activity already updated </br>';						
					}
					
				} else {
					print '    OTHER APPLICATION - app_id = ' . $integration->app_id . '</br>';
				}
			}
						
		}
		
		// FOOTER
		require APP . 'view/_templates/home-footer.php';
	}
	
	/*
	 * 
	 * Page to run the refresh job for ALL CONTENT. Be Carefull it'll take sometime!!
	 * 
	 */
	public function runFullJob() {
		$this->isAdmin ();
		
		$user = $this->authUser;
		
		// HEADER
		require APP . 'view/_templates/home-header.php';
		require APP . 'view/admin.php';
		
		// CONTENT
		$users = $this->userModel->getAllUsers ();
		
		require_once APP . 'models/activityModel.php';
		$activityModel = new ActivityModel ( $this->db );

		require_once APP . 'models/integrationModel.php';
		$integrationModel = new IntegrationModel ( $this->db );
		
		// Load Strava API
		require_once APP . 'lib/stravaAPI.php';
		$stravaAPI = new stravaAPI ();
		
		
		// Load Runkeeper API
		require_once APP . 'lib/runkeeperAPI.php';
		$rkAPI = new runkeeperAPI ();
		
		
		// For each user
		foreach ( $users as $singleUser ) {
			$integrations = $integrationModel->getAllIntegrationsByUserId($singleUser->id);

			print '<br/><h4>Name: ' . $singleUser->name . '</h4> <h5>Created at: ' . $singleUser->created_at . '  ' . '  Deleted? ' . $singleUser->deleted . '</h5></br>';
				
			// And each integration of this user
			foreach ($integrations as $integration) {
				if ($integration->app_id == STRAVA_ID) {
					// Save Last activity for Strava
					$stravaAPI->setStravaToken ( $integration->token );
					$stravaActivities = $stravaAPI->getLastActivity ();
										
					$retAct = $activityModel->insertActivity ( 
							$integration->id, 
							strtotime ( $stravaActivities [0] ['start_date_local'] ), 
							$stravaActivities [0] ['type'], 
							$stravaActivities [0] ['distance'], 
							'0' ); // no calories for Strava =(
					
					if ($retAct) {
						print '    Strava activity updated - ' . $stravaActivities [0] ['start_date_local'] . '</br>';
					} else {
						print '    Strava activity already updated </br>';
					}
								
				} elseif ($integration->app_id == RUNKEEPER_ID) {
					// Save ALL activities for Runkeeper
					$rkAPI->setRunkeeperToken( $integration->token );
					$rkActivities = $rkAPI->getAllActivities();
					
					$size = $rkActivities ['size'];
					if (!isset($size)) {
						$size = 0;
					}
					// Page size is 99
					if ($size > 99) {
						$size = 99;
					}

					for ($i = 0; $i <= $size-1; $i++) {

						$start_time = $rkActivities ['items'] [$i] ['start_time'];
						$type = $rkActivities ['items'] [$i] ['type'];
						$total_distance = $rkActivities ['items'] [$i] ['total_distance'];
						$total_calories = $rkActivities ['items'] [$i] ['total_calories'];
						/*
						ADD VALIDATION HERE
						 */
						if ($total_distance < 999999) {
							// Save Activity
							$retAct = $activityModel->insertActivity ( 
								$integration->id, strtotime($start_time), $type, $total_distance, $total_calories);
						}

						if ($retAct) {
							print '    Runkeeper activity updated - ' . $start_time . '</br>';
						} else {
							print '    Runkeeper activity ('. $start_time .') already updated </br>';			
						}
					}
					
				} else {
					print '    OTHER APPLICATION - app_id = ' . $integration->app_id . '</br>';
				}
			}
						
		}
		
		// FOOTER
		require APP . 'view/_templates/home-footer.php';
	}


	/*
	 * 
	 * Page to list all Users
	 * 
	 */
	public function users() {
		$this->isAdmin ();
		
		$user = $this->authUser;
		
		// HEADER
		require APP . 'view/_templates/home-header.php';
		require APP . 'view/admin.php';
		
		// CONTENT
		
		$users = $this->userModel->getAllUsers ();
		
		require_once APP . 'models/activityModel.php';
		$activityModel = new ActivityModel ( $this->db );
		
		foreach ( $users as $singleUser ) {
			print '<br/>Name: ' . $singleUser->name . '  Created at: ' . $singleUser->created_at . '  ' . '  Deleted? ' . $singleUser->deleted . '</br>';
			
			$activity = $activityModel->getLastActivityByIntegrationId ( $singleUser->id );
			if (isset ( $activity->start_date )) {
				print '    Last activity on: ' . date ( "Y-m-d H:i:s", $activity->start_date ) . '</br>';
			}
		}
		
		// FOOTER
		require APP . 'view/_templates/home-footer.php';
	}
	
	/*
	 * 
	 * Page to post a new cart into Smart Canvas
	 * 
	 */
	public function smartCanvas() {
		// Something related to Smart Canvas =)
	}
	
	
	/*
	 * 
	 * Internal methods
	 * 
	 */
	
	
	// Authentication
	private function isAdmin() {
		require_once APP . 'models/userModel.php';
		$this->userModel = new UserModel ( $this->db );
		
		$name = isset ( $_POST ['name'] ) ? $_POST ['name'] : null;
		$email = isset ( $_POST ['email'] ) ? $_POST ['email'] : null;
		$image_path = isset ( $_POST ['image'] ) ? $_POST ['image'] : null;
		
		// Check logged user by POST, SESSION or COOKIE
		if (empty ( $email )) {
			if (isset ( $_SESSION [SESSION_NAME] )) {
				$this->authUser = $this->userModel->getUserByToken ( $_SESSION [SESSION_NAME] );
			} else if (isset ( $_COOKIE [COOKIE_NAME] )) {
				$this->authUser = $this->userModel->getUserByToken ( $_COOKIE [COOKIE_NAME] );
			} else {
				
				// If user is not authenticated, redirect to error page
				header ( 'location: ' . URL . 'error?error=AUTH_ERROR' );
			}
		} else {
			$this->authUser = $this->userModel->getUserByEmail ( $email );
		}
		
		if (empty ( $this->authUser->id ) && ! empty ( $email )) {
			$this->authUser = $this->userModel->getUserByEmail ( $email );
		}
		
		// ALREADY CONNECTED AND LOGGED //
		
		// Check role
		$role = $this->authUser->role;
		
		if (is_null ( $role ) || $role != ROLE_ADMIN) {
			// Not an Admin, go away!
			header ( 'location: ' . URL . 'error?error=AUTH_NOT_AUTHORIZED' );
		}
		
		// Save userId in Session
		$_SESSION [SESSION_NAME] = $this->authUser->remember_token;
		
		// Save userId in Cookie
		$_COOKIE [COOKIE_NAME] = $this->authUser->remember_token;
		
		return true;
	}
}
