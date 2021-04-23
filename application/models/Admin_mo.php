<?php
class Admin_mo extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}
	
	public function rate($select,$table,$where)
     {   
       $query = $this->db->query("SELECT  $select FROM $table $where");
       return $query->result();
     }
	
	public function exist($table,$where,$limit)
	{
		$query = $this->db->query("SELECT count(*) as count FROM $table $where $limit");
		return $query->row()->count;
	}
	
	public function mycount($table,$where,$limit)
	{
		$query = $this->db->query("SELECT id FROM $table $where $limit");
		return $query->num_rows();
	}
	
	public function getrow($table,$row)
	{
		$query = $this->db->get_where($table, $row);
		return $query->row();
	}
	
	public function getwhere($table,$row)
	{
		$query = $this->db->get_where($table, $row);
		return $query->result();
	}
	
	public function get($table)
	{
		$query = $this->db->get($table);
		return $query->result();
	}
	
	public function getjoin($select,$table,$jointable,$on,$where)
	{
		$this->db->select($select);
		$this->db->from($table);
		$this->db->join($jointable, $on);
		foreach($where as $key => $value)
		{
			$this->db->where($key, $value);
		}
		$query = $this->db->get();
		return $query->result();
	}
	
	public function getjoinR($select,$table,$jointable,$where)
	{
		$this->db->select($select);
		$this->db->from($table);
		foreach($jointable as $join => $on)
		{
			$this->db->join($join, $on);
		}
		foreach($where as $key => $value)
		{
			$this->db->where($key, $value);
		}
		$query = $this->db->get();
		return $query->result();
	}
	
	public function getjoinLeft($select,$table,$jointable,$where)
	{
		$this->db->select($select);
		$this->db->from($table);
		foreach($jointable as $join => $on)
		{
			$this->db->join($join, $on, 'LEFT OUTER');
		}
		$this->db->where($where);
		$query = $this->db->get();
		return $query->result();
	}
	
	function getrowjoinLeftLimit($select,$table,$jointable,$where)
	{
		$this->db->select($select);
		$this->db->from($table);
		foreach($jointable as $join => $on)
		{
			$this->db->join($join, $on, 'LEFT OUTER');
		}
		$this->db->where($where);
		$query = $this->db->get();
		return $query->row();
	}
	
	public function getjoinLeftLimit($select,$table,$jointable,$where,$orderby,$limit)
	{
		$this->db->select($select);
		$this->db->from($table);
		foreach($jointable as $join => $on)
		{
			$this->db->join($join, $on, 'LEFT OUTER');
		}
		$this->db->where($where);
		$this->db->order_by($orderby);
		$this->db->limit($limit);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function set($table,$row)
	{
		$this->db->insert($table,$row);
		return $this->db->insert_id();
	}
	
	public function update($table,$row,$where)
	{
		foreach($where as $key => $value)
		{
			$this->db->where($key, $value);
		}
		$this->db->update($table, $row);
		if($this->db->affected_rows() > 0) return 1;
		else return 0;
	}
	
	public function updateM1($table,$row,$where)
	{
		$this->db->where($where);
		$this->db->update($table, $row);
	}
	
	public function updateM($table,$set,$where)
     {   
       $query = $this->db->query("UPDATE $table SET $set $where");
       return $query->result();
     }
	
	public function del($table,$row)
	{
		$this->db->delete($table, $row);
	}
}
?>