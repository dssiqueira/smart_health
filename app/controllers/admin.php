<?php

/**
 * Admin Controller
 *
 */
class Admin extends Controller
{

	public $authUser = null;
	public $userModel = null;
	
	private $include_html = null; 
	
	public function index()
	{
		$this->isAdmin();
		
		$user = $this->authUser;
		
		require APP . 'view/_templates/home-header.php';
		require APP . 'view/admin.php';
		require APP . 'view/_templates/home-footer.php';
	}
	
	public function runJob()
	{
		$this->include_html .= 'test';
		$this->index();
	}
	
	public function users()
	{
		$this->isAdmin();
	
		$user = $this->authUser;
	    
		// HEADER
		require APP . 'view/_templates/home-header.php';
		require APP . 'view/admin.php';
	
		// CONTENT
		
		$users = $this->userModel->getAllUsers();
	
		require_once APP . 'models/activityModel.php';
		$activityModel = new ActivityModel($this->db);
		
		foreach ($users as $singleUser){
			print '<br/>Name: ' . $singleUser->name .
			'  Created at: ' . $singleUser->created_at . '  ' .
			'  Deleted? ' .$singleUser->deleted . '</br>';
			
			$activity = $activityModel->getLastActivityByIntegrationId($singleUser->id);
			if (isset($activity->start_date)) {
				print '    Last activity on: ' . date("Y-m-d H:i:s", $activity->start_date) . '</br>';
			}
			
		}
		
		// FOOTER
		require APP . 'view/_templates/home-footer.php';
	}	
	
	public function smartCanvas()
	{
		// Something related to Smart Canvas =)
	}

	
	
	
	// Authentication
	private function isAdmin() {
	
		require_once APP . 'models/userModel.php';
		$this->userModel = new UserModel($this->db);
	
		$name = isset( $_POST ['name'] ) ? $_POST ['name'] : null;
		$email = isset( $_POST ['email'] ) ? $_POST ['email'] : null;
		$image_path = isset( $_POST ['image'] ) ? $_POST ['image'] : null;
	
		// Check logged user by POST, SESSION or COOKIE
		if ( empty($email) ) {
			if (isset ( $_SESSION [SESSION_NAME] )) {
				$this->authUser = $this->userModel->getUserByToken ( $_SESSION [SESSION_NAME] );
			} else if (isset ( $_COOKIE [COOKIE_NAME] )) {
				$this->authUser = $this->userModel->getUserByToken ( $_COOKIE [COOKIE_NAME] );
			} else {
				 
				// If user is not authenticated, redirect to error page
				header('location: ' . URL . 'error?error=AUTH_ERROR');
	
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
		
		if (is_null($role) || $role != ROLE_ADMIN) {
			// Not an Admin, go away!
			header('location: ' . URL . 'error?error=AUTH_NOT_AUTHORIZED');
				
		}
		
		// Save userId in Session
		$_SESSION [SESSION_NAME] = $this->authUser->remember_token;
	
		// Save userId in Cookie
		$_COOKIE [COOKIE_NAME] = $this->authUser->remember_token;
		
		return true;
	}	
}
