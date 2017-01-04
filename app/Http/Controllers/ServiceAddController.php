<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Service;
use Validator;

class ServiceAddController extends Controller
{
    public function index(Request $request) {
    	
    	if($request->isMethod('post')) {
			$input = $request->except('_token');
			
			
			
			 $validator = Validator::make($input, [
	            'name' => 'required|max:255',
	            'text' => 'required'
	        ]);

	        if ($validator->fails()) {
	        	
	            return redirect()->route('portfoliosAdd')
	                        ->withErrors($validator)
	                        ->withInput();
	        }
	        
	        $service = new Service();
	        $service->fill($input);
	        if($service->save()) {
				return redirect('admin')->with('status', 'Страница добавлена');
			}
		}
		
		if(view()->exists('admin.services_add')) {
			
			$data = [
					
					'title' => 'Новый сервис'
					
					];
			return view('admin.services_add',$data);
		}
	}
}
