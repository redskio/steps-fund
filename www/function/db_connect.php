<?php
class DBC
{
	public $db;
	public $query;
	public $result;

	public function DBI()
	{
		$this->db = new mysqli('h8.woobi.co.kr', 'tooza', 'k1001', 'tooza'); //host, id, pw, database 순서입니다.
		$this->db->query('SET NAMES UTF8');
		if(mysqli_connect_errno())
		{
			exit;
		}
	}

	public function DBQ()
	{
		$this->result = $this->db->query($this->query);
	}

	public function DBO()
	{
		$this->result->free;
		$this->db->close();
	}
}
?>