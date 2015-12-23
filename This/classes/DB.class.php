	<?php 
	class DB {

		private static $instance = null;
		private $mysqli;

		const DB_URL = 'localhost';
		const DB_USR = 'root';
		const DB_PWD = 'root';
		const DB_DTB = 'Pointgame';

		function __construct() {

			$this->mysqli = new mysqli(self::DB_URL, self::DB_USR, self::DB_PWD, self::DB_DTB);

		}

		public function getMysqli() {
			return $this->mysqli;
		}

		// funktion för att tvätta det som skickas från ett formulär med POST, används inte utanför klassen
		public function clean($input) {

			if(is_array($input)) {
			
				// en array med tvättade värden som matas ut
				$clean_data = [];

				// loopa igenom $_POST
				foreach($input as $key => $value) {
					$clean_data[$key] = $this->mysqli->real_escape_string($value);
				}

			}

			else {

				$clean_data = $this->mysqli->real_escape_string($input);

			}
		
			return $clean_data;

		}

}