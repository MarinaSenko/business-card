<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Service;

class ServiceController extends Controller
{
     public function index() {
		
		if(view()->exists('admin.services')) {
			
			$services = Service::all();
			
			$data = [
					'title'=>'Сервисы',
					'services'=>$services
					];
			
			return view('admin.services',$data);
		}
		
	}
}
