<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_model extends CI_Model
{
	public function getList($table, $select = '*', $where = [])
	{
		return $this -> db -> select($select)
			-> where($where)
			-> get($table) -> result();
	}

	public function selectOne($table, $select = '*', $where = [])
	{
		return $this -> db -> select($select)
			-> where($where)
			-> get($table) -> row();
	}
}
