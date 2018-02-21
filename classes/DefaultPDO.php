<?php
/*
 * Created on 2007-4-8
 *
 * jack@jetphoto.cn
 *
 * www.javaphp.com 
 */
abstract class DefaultPDO implements JPDO {
	
	protected $pdo = null;
	
	public function __construct($pdo) {
		$this->pdo = $pdo;
		$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->pdo->beginTransaction();
	}

	public function array_encode($array) {
		$list = array();
		foreach($array as $value) {
			if(is_array($value)) {
				array_push($list, $this->array_encode($value));
			}
			else {
				$value = str_replace("{", "\{", $value);
				$value = str_replace("}", "\}", $value);
				$value = str_replace(",", "\,", $value);
				array_push($list, $value);
			}
		}
		$result = '{';
		$result .= join($list, ',');
		$result .= '}';
		return $result;
	}
	
	public function array_decode($value) {
		$value	= trim($value, '{}');
		$array	= explode(',', $value);
		return $array;
	}
	
	public function call($_function, $_args = null) {
		$ps = $this->pdo->prepare($_function);
		if (is_array($_args)) {
			$ps->execute($_args);
		}
		else {
			$ps->execute();
		}
		$index = 0;
		$ps->bindColumn(1, $index);
		$ps->fetch(3);
		$ps->closeCursor();
		return $index;
	}
	
	public function errorInfo() {
		return $this->pdo->errorInfo();
	}
	
	public function exec($_sql) {
		return $this->pdo->exec($_sql);
	}
	
	public function execute($_sql, $_args = null) {
		$ps = $this->pdo->prepare($_sql);
		$ps->execute($_args);
		return $ps->rowCount();
	}
	
	public function executes($_sql, $_args, $_times) {
		$count = 0;
		$ps = $this->pdo->prepare($_sql);
		while(--$_times >= 0) {
			$values = array();
			foreach($_args as $object) {
				if(is_array($object)) {
					$values[] = $object[$_times];
				}
				else {
					$values[] = $object;
				}
			}
			$ps->execute($values);
			$count += $ps->rowCount();
		}
		return $count;
	}
	
	public function getPDO() {
		return $this->pdo;
	}
	
	public function getRow($_sql, $_args = null) {
		$table = $this->query($_sql, $_args);
		if(isset($table[0])) return $table[0];
		else return null;
	}
	
	public function query($_sql, $_args = null) {
		$ps = $this->pdo->prepare($_sql);
		if (is_array($_args)) {
			$ps->execute($_args);
		}
		else {
			$ps->execute();
		}
		$ps->setFetchMode(PDO::FETCH_NAMED);
		$table = $ps->fetchAll();
		$ps->closeCursor();
		return $table;
	}
	
	public function queries($sql, $args) {
		$total = 0;
		$ps = $this->pdo->prepare($sql);
		foreach($args as $arg) {
			$ps->execute($arg);
			$total += $ps->rowCount();
		}
		return $total;
	}
	private function join_insert_sql($_table, $_values) {
		$sql = 'INSERT INTO ';
		$sql .= $_table;
		$sql .= ' (';
		$index = 0;
		$length = count($_values);
		foreach ($_values as $key => $value) {
			$sql .= $key;
			if (++ $index < $length)
				$sql .= ', ';
		}
		$sql .= ') VALUES (';
		for ($i = count($_values); -- $i >= 0;) {
			$sql .= '?';
			if ($i > 0)
				$sql .= ', ';
		}
		$sql .= ')';
		return $sql;
	}
	
	public function insert($_table, $_values) {
		return $this->execute(DefaultPDO::join_insert_sql($_table, $_values), array_values($_values));
	}
	
	public function inserts($_table, $_values, $_times) {
		return $this->executes(DefaultPDO::join_insert_sql($_table, $_values), $_values, $_times);
	}
	
	public function update($_table, $_values, $_conditions) {
		$sql = 'UPDATE ' . $_table . ' SET ';
		$index = 0;
		$length = count($_values);
		foreach ($_values as $key => $value) {
			$sql .= $key;
			$sql .= ' = ?';
			if (++ $index < $length)
				$sql .= ', ';
		}
		$sql .= DefaultPDO::join_and($_conditions);
		return $this->execute($sql, array_merge(array_values($_values), array_values($_conditions)));
	}
	
	protected static function join_and ($_conditions) {
		if (is_array($_conditions)) {
			$sql = ' WHERE ';
			$index = 0;
			$length = count($_conditions);
			foreach ($_conditions as $key => $value) {
				$sql .= $key;
				$sql .= ' = ?';
				if (++ $index < $length)
					$sql .= ' AND ';
			}
			return $sql;
		}
		return '';
	}
	
	public function delete($_table, $_conditions) {
		return $this->execute('DELETE FROM ' . $_table . DefaultPDO::join_and($_conditions), array_values($_conditions));
	}
	
	public function total($table) {
		return $this->call('SELECT COUNT(*) FROM ' . $table);
	}
	public function __destruct() {
		if($this->pdo) {
			$this->pdo->commit();
			$this->pdo = null;			
		}
	}
}
?>