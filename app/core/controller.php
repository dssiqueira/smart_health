<?php
class Controller {
	/**
	 *
	 * @var null Database Connection
	 */
	public $db = null;
	/**
	 *
	 * @var null Model
	 */
	public $model = null;
	
	/**
	 * Whenever controller is created, open a database connection too and load "the model".
	 */
	function __construct() {
		
		// start session
		session_start ();
		
		// getting the className of the Controller who extends controller class
		$class = get_called_class ();
		$this->openDatabaseConnection ();
		// passing this classname as parameter to loadModel Function
		$this->model = $this->loadModel ( $class );
	}
	/**
	 * Open the database connection with the credentials from application/config/config.php
	 */
	private function openDatabaseConnection() {
		// set the (optional) options of the PDO connection. in this case, we set the fetch mode to
		// "objects", which means all results will be objects, like this: $result->user_name !
		// For example, fetch mode FETCH_ASSOC would return results like this: $result["user_name] !
		$options = array (
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
				PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING 
		);
		// generate a database connection, using the PDO connector
		$this->db = new PDO ( DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASS, $options );
	}
	/**
	 * Loads the "model".
	 *
	 * @return object model
	 */
	public function loadModel($model_name = null) {
		
		// Auto-load common Model
		require_once APP . 'core/model.php';
		$new_model = APP . 'models/' . strtolower ( $model_name ) . 'Model.php';
		
		if (is_file ( $new_model )) {
			
			require_once $new_model;
			
			$model = $model_name . 'Model';
			$return_model = new $model ( $this->db );
		} else {
			$return_model = new Model ( $this->db );
		}
		
		return $return_model;
	}
}
