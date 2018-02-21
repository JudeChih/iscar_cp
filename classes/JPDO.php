<?php
/*
 * Created on 2007-4-8
 *
 * jack@jetphoto.cn
 *
 * www.javaphp.com 
 */
interface JPDO {
	
	public function array_encode($array);
	
	public function array_decode($string);
	
	public function call($_sql, $_args = null);
	
	public function errorInfo();
	
	public function exec($_sql);
	
	public function queries($sql, $args);
	
	public function execute($_sql, $_args = null);
	
	public function executes($_sql, $_args, $_times);
	
	public function getRow($_sql, $_args = null);
	
	public function getPDO();
	
	public function select($_table, $_conditions = null, $order = null, $_offset = null, $_limit = null);
	
	public function query($_sql, $_args = null);
	
	public function insert($_table, $_args);
	
	public function inserts($_table, $_args, $times);
	
	public function update($_table, $_args, $_conditions);
	
	public function delete($_table, $_conditions);
	
	public function total($table);
	
	public function __destruct();
}
?>