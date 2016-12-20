<?php

/**
 * Class Home
 *
 */
class Home extends Controller {
	public $authUser = null;
	public $userModel = null;
	public $pollsModule = null;
	
	/*
	 *
	 * PAGES
	 *
	 */
	public function index() { // This is the page "Home"
		$this->isAuthenticated ();
		$this->addUser ();
		
		$user = $this->authUser;
		
		require_once APP . '/models/integrationModel.php';
		$integrationModule = new IntegrationModel ( $this->db );
		
		$isStravaConnected = $integrationModule->getIntegrationByUserIdAndAppId ( $user->id, STRAVA_ID, 0 );
		$isRunkeeperConnected = $integrationModule->getIntegrationByUserIdAndAppId ( $user->id, RUNKEEPER_ID, 0 );
		
		require_once APP . '/models/pollModel.php';
		$pollsModule = new PollModel ( $this->db );
		
		// require load
		require APP . 'view/_templates/home-header.php';
		require APP . 'view/home.php';
		require APP . 'view/_templates/home-footer.php';
	}

	public function about() {
		$this->isAuthenticated ();
		$user = $this->authUser;
		
		require APP . 'view/_templates/home-header.php';
		require APP . 'view/about.php';
		require APP . 'view/_templates/home-footer.php';
	}

	public function nextstep() {
		$this->isAuthenticated ();
		$user = $this->authUser;
		
		require APP . 'view/_templates/home-header.php';
		require APP . 'view/nextstep.php';
		require APP . 'view/_templates/home-footer.php';
	}

	public function getAllIntegrations() {
		$integration = new integration ();
		
		$applist = $integration->getAllAppsByUserId ( $user->uid );
	}
	
	/*
	 *
	 * POLLS
	 *
	 */
	public function vote() {
		$poll = isset ( $_POST ['poll'] ) ? $_POST ['poll'] : null;
		$vote = isset ( $_POST ['vote'] ) ? $_POST ['vote'] : null;
		
		require_once APP . '/models/pollModel.php';
		$pollsModule = new PollModel ( $this->db );
		
		if (! empty ( $poll )) {
			$this->isAuthenticated ();
			
			$pollsModule->setVoteByUserId ( $this->authUser->id, $poll, $vote );
		}
		
		header ( 'location: ' . URL . 'home' );
	}
	
	// Authentication
	private function isAuthenticated() {
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
		// Save userId in Session
		$_SESSION [SESSION_NAME] = $this->authUser->remember_token;
		
		// Save userId in Cookie
		$_COOKIE [COOKIE_NAME] = $this->authUser->remember_token;
	}
	
	private function addUser() {
		$name = isset ( $_POST ['name'] ) ? $_POST ['name'] : null;
		$email = isset ( $_POST ['email'] ) ? $_POST ['email'] : null;
		$image_path = isset ( $_POST ['image'] ) ? $_POST ['image'] : null;
		
		if (! empty ( $name ) && ! empty ( $email ) && ! empty ( $image_path )) {
			$this->userModel->insertUser ( $email, $name, $image_path );
		}
	}
}
