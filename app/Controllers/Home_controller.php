<?php namespace App\Controllers;

class Home_controller extends BaseController {

	public function index(){
        $data['title'] = 'MENU PRINCIPAL';
		return view('index_view', $data);
	}
}