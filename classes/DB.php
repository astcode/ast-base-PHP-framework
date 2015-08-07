<?php
class DB {
	public static $instance = null;

	private 	$_pdo = null,
				$_query = null,
				$_error = false,
				$_results = null,
				$_lastIdInsert = null,
				$_count = 0;

	private function __construct() {
		$mysql = (DB::isNotLive()) ? 'mysql_local' : 'mysql_live' ;
		try {
			$this->_pdo = new PDO('mysql:host=' .
			                      trim(Config::get($mysql.'/host')) . ';dbname=' .
			                      trim(Config::get($mysql.'/db')),
			                      trim(Config::get($mysql.'/username')),
			                      trim(Config::get($mysql.'/password')));
		} catch(PDOExeption $e) {
			die($e->getMessage());
		}
	}

	public static function isNotLive()
	{
		return (!checkdnsrr($_SERVER['SERVER_NAME'], 'NS')) ? true : false ;
	}

	public static function setAttribute() {
		// Already an instance of this? Return, if not, create.
		$db = new DB();
		return $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
	}

	public static function getInstance() {
		// Already an instance of this? Return, if not, create.
		if(!isset(self::$instance)) {
			self::$instance = new DB();
		}
		return self::$instance;
	}

	public function query($sql, $params = array()) {
		// echo $sql;
		// die();
		$this->_error = false;

		if($this->_query = $this->_pdo->prepare($sql)) {
			$x = 1;
			if(count($params)) {
				foreach($params as $param) {
					$this->_query->bindValue($x, $param);
					$x++;
				}
			}
		// 	echo "<pre>"; var_dump($this); var_dump($params); echo "</pre>";
		// die();

			if($this->_query->execute()) {
				$this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
				$this->_count = $this->_query->rowCount();
			} else {
				$this->_error = true;
			}
		}

		return $this;
	}

	public function query_assoc($sql, $params = array()) {
		// echo $sql;
		// die();
		$this->_error = false;

		if($this->_query = $this->_pdo->prepare($sql)) {
			$x = 1;
			if(count($params)) {
				foreach($params as $param) {
					$this->_query->bindValue($x, $param);
					$x++;
				}
			}

			if($this->_query->execute()) {
				$this->_results = $this->_query->fetchAll(PDO::FETCH_ASSOC);
				$this->_count = $this->_query->rowCount();
			} else {
				$this->_error = true;
			}
		}

		return $this;
	}

	public function get($table, $where) {
		return $this->action('SELECT *', $table, $where);
	}

	public function delete($table, $where) {
		return $this->action('DELETE', $table, $where);
	}

	public function action($action, $table, $where = array()) {
		if(count($where) === 3) {
			$operators = array('=', '>', '<', '>=', '<=');

			$field 		= $where[0];
			$operator 	= $where[1];
			$value 		= $where[2];

			if(in_array($operator, $operators)) {
				$sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";

				if(!$this->query($sql, array($value))->error()) {
					return $this;
				}

			}

			return false;
		}
	}

	public function insert($table, $fields = array()) {
		$keys 	= array_keys($fields);
		$values = null;
		$x 		= 1;

		foreach($fields as $value) {
			$values .= "?";
			if($x < count($fields)) {
				$values .= ', ';
			}
			$x++;
		}
		// echo "<pre>";
		// var_dump($fields);
		// echo "</pre>";
		// echo $values;

		$sql = "INSERT INTO {$table} (`" . implode('`, `', $keys) . "`) VALUES ({$values})";

// 		echo $sql;
// die();

		if(!$this->query($sql, $fields)->error()) {
			return true;
		}

		return false;
	}

	public function update($table, $id, $fields = array()) {
		$set 	= null;
		$x		= 1;

		foreach($fields as $name => $value) {
			$set .= "{$name} = ?";
			if($x < count($fields)) {
				$set .= ', ';
			}
			$x++;
		}

		// echo $sql = "UPDATE users SET {$set} WHERE id = {$id}"; die();
		$sql = "UPDATE {$table} SET {$set} WHERE id = {$id}";

		if(!$this->query($sql, $fields)->error()) {
			return true;
		}

		return false;
	}

	public function updateAbstract($table, $id, $fields = array(), $arg) {
		$set 	= null;
		$x		= 1;

		foreach($fields as $name => $value) {
			$set .= "{$name} = ?";
			if($x < count($fields)) {
				$set .= ', ';
			}
			$x++;
		}

		// echo $sql = "UPDATE {$table} SET {$set} WHERE {$arg} = {$id}"; die();
		$sql = "UPDATE {$table} SET {$set} WHERE {$arg} = {$id}";

		if(!$this->query($sql, $fields)->error()) {
			return true;
		}

		return false;
	}

	public function results() {
		// Return result object
		return $this->_results;
	}

	public function lastInsertId() {
		// Return result object
		var_dump($this->_query->lastInsertId());
		return $this->_query->lastInsertId();
	}

	public function lastInsertIdecho() {
		// Return result object
		// var_dump($this->_pdo->lastInsertId());
		return $this->_pdo->lastInsertId();
	}

	public function first() {
		// echo "<pre>"; var_dump($this); echo "</pre>";
		// echo $this->count();
		if ($this->count() > 0) {
			return $this->_results[0];
		} else {
			Redirect::to('search.php');
		}
	}

	public function count() {
		// Return count
		return $this->_count;
	}

	public function error() {
		return $this->_error;
	}
}