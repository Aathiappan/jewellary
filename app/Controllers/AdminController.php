<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\CategoryModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class AdminController extends BaseController
{
	use ResponseTrait;
    public function index()
    {
        return view('admin/layout/header')
		.view('admin/layout/footer');
    }
	
	public function listCategory(){
		//echo 'hi';
		$categoryModel = new CategoryModel();
		$allCategory = $categoryModel->getAllCategory();
		$data['category'] = $allCategory;
		return view('admin/layout/header')
			.view('admin/category',$data)
			.view('admin/layout/footer');
	}
	public function addCategory(){
		$jsonData = $this->request->getJSON();
		$jsonData = json_decode(json_encode($jsonData),true);
		$categoryModel = new CategoryModel();
		if($categoryModel->addCategory($jsonData)){
			return $this->respond(["status"=> true, "message" => "Category successfully added","categories" => $categoryModel->getAllCategory()],200);
		}else{
			return $this->respond(["status"=> false, "message" => "Something went wrong"],200);
			log_message('error', "Catagory add db error -- not inserted");
		}
		
	}
}
