<?php

/**
 * Default Controller
 *
 */
class Welcome extends Controller {
	public function index() {

		require_once APP . 'models/userModel.php';
		$this->userModel = new UserModel ( $this->db );

		$usersCount = $this->userModel->getUsersCount();
		$usersCount = isset($usersCount)?$usersCount->count : 0;

        $lastUsers = $this->userModel->getLastUsers(5);

		require_once APP . 'models/activityModel.php';
		$this->activityModel = new activityModel ( $this->db );
        
        $totalDistance = $this->activityModel->getTotalDistance()->sum;
        $totalDistance = isset($totalDistance)?$totalDistance/1000:0;

		// just load the homepage
		require_once APP . 'view/index.php';
	}
}
