<?php

/**
 * Default Controller
 *
 */
class Welcome extends Controller {
	public function index() {
		// just load the homepage
		require_once APP . 'view/index.php';
	}
}
