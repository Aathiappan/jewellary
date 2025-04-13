<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }
	
	public function getAllCategory(){
		//$data = $this->db->table('category')->select('*')->get()->getResultArray();
		$sql = "SELECT cat.*,catParent.name as parentname FROM `category` as cat LEFT JOIN `category` as catParent ON cat.parent = catParent.id";
		$query = $this->db->query($sql);
		$data = $query->getResultArray();
		return $data;
	}
	
	public function addCategory(array $data){
		$data["created_at"] = date("Y-m-d H:i:s");
		$this->db->transStart();
        $sql = "INSERT INTO category (name,parent,created_at) VALUES(:name:,:parent:,:created_at:)";
        $this->db->query($sql, $data);
        $insertedId = $this->db->insertID();
		$this->db->transComplete();
        return $this->db->transStatus();
	}
}
