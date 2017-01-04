<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\PagesRequest;
use Validator;
use App\Service;

class ServiceEditController extends Controller
{
    public function index(Request $request, $id) {
		
		$service = Service::find($id);

		if(!$service) {
			return redirect('admin');
		}
		
		if($request->isMethod('delete')) {
			$service->delete();
			return redirect('admin')->with('status','Сервис удален');
		}
		
		
		if($request->isMethod('post')) {
			
			$input = $request->except('_token');
				
			 
			 $validator = Validator::make($input, [
	            'name' => 'required|max:255',
	            'text' => 'required|max:255'
	        ]);

	        if ($validator->fails()) {
	        	
	            return redirect()->route('servicesEdit',['service'=>$input['id']])
	                        ->withErrors($validator);
	        }
	        

	        $service->fill($input);
	        if($service->update()) {
				return redirect('admin')->with('status', 'Сервис обновлен');
			}
		}
		
		

		if(view()->exists('admin.services_edit')) {
			
			$data = [
					
					'title' => 'Редактирование страницы - '.$service['name'],
					'data'  => $service
					];
				
			return view('admin.services_edit',$data);
		}
	}
}
