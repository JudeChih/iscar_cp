<?php

/*
 * Created on 2007-4-11
 *
 * jack@jetphoto.cn
 *
 * www.javaphp.com 
 */
class MySQLPDO extends DefaultPDO implements JPDO {

	public function __construct($pdo) {
		parent::__construct($pdo);
		#$this->exec('SET CHARACTER SET UTF8');
		$this->exec('SET NAMES UTF8');
	}
	
	public function query($_sql, $_args = null) {
		$ps = $this->pdo->prepare($_sql);
		if (is_array($_args)) {
			for ($index = count($_args); $index > 0;) {
				$ps->bindParam($index--, $_args[$index], is_int($_args[$index]) ? PDO :: PARAM_INT : PDO :: PARAM_STR);
			}
		}
		$ps->execute();
		$ps->setFetchMode(2);
		$table = $ps->fetchAll();
		$ps->closeCursor();
		return $table;
	}
	
	public function select($_table, $_conditions = null, $order = null, $_offset = null, $_limit = null) {
		$sql = 'SELECT * FROM ';
		$sql .= $_table;
		if(isset($_conditions)) {
			$sql .= DefaultPDO::join_and($_conditions);
			$values = array_values($_conditions);
		}
		if(isset($order)) {
			$sql .= ' ORDER BY ';
			$sql .= $order;
		}
		if(isset($_offset)) {
			$sql .= ' LIMIT ?';
			$values[] = $_offset;
		}
		if(isset($_limit)) {
			$sql .= ', ?';
			$values[] = $_limit;
			if($_limit == 1) {
				return $this->getRow($sql, $values);
			}
		}
		if(isset($values)) {
			return $this->query($sql, $values);
				
		}
		else {
			return $this->query($sql);
		}
	}
}
?>