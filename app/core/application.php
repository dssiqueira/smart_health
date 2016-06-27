<?php
class Application {
	private $url_controller = null;
	private $url_action = null;
	private $url_params = array ();
	public function __construct() {
		// create array with URL parts in $url
		$this->splitUrl ();
		
		// check if it's redirect to the error page, which will not use controller
		if ($this->url_controller == 'error') {
			require APP . 'view/error.php';
			exit ();
		}
		// check for controller: no controller given ? then load start-page
		if (! $this->url_controller) {
			
			require_once APP . 'controllers/welcome.php';
			$page = new Welcome ();
			$page->index ();
		} elseif (file_exists ( APP . 'controllers/' . $this->url_controller . '.php' )) {
			
			require_once APP . 'controllers/' . $this->url_controller . '.php';
			$this->url_controller = new $this->url_controller ();
			
			// check for method: does such a method exist in the controller ?
			if (method_exists ( $this->url_controller, $this->url_action )) {
				
				if (! empty ( $this->url_params )) {
					// Call the method and pass arguments to it
					call_user_func_array ( array (
							$this->url_controller,
							$this->url_action 
					), $this->url_params );
				} else {
					// If no parameters are given, just call the method without parameters, like $this->home->method();
					$this->url_controller->{$this->url_action} ();
				}
			} else {
				if (strlen ( $this->url_action ) == 0) {
					// no action defined: call the default index() method of a selected controller
					$this->url_controller->index ();
				} else {
					header ( 'location: ' . URL . 'error', TRUE, 302 );
				}
			}
		} else {
			header ( 'location: ' . URL . 'error', TRUE, 302 );
		}
	}
	
	/**
	 * Get and split the URL
	 */
	private function splitUrl() {
		if (isset ( $_GET ['url'] )) {
			
			// split URL
			$url = trim ( $_GET ['url'], '/' );
			$url = filter_var ( $url, FILTER_SANITIZE_URL );
			$url = explode ( '/', $url );
			
			$this->url_controller = isset ( $url [0] ) ? $url [0] : null;
			$this->url_action = isset ( $url [1] ) ? $url [1] : null;
			
			// Remove controller and action from the split URL
			unset ( $url [0], $url [1] );
			
			// Rebase array keys and store the URL params
			$this->url_params = array_values ( $url );
		}
	}
}
