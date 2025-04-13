<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
		//log_message('debug','error no '.date("Y-m-d H:i:s"));
		//$user = auth()->user();
		//echo json_encode($user);
        //return view('welcome_message');
		return view('public/layout/header')
		.view('public/layout/footer');
    }
	
}
