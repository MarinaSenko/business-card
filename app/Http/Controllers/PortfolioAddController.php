<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Portfolio;
use Validator;

class PortfolioAddController extends Controller
{
    public function index(Request $request) {
    	
    	if($request->isMethod('post')) {
			$input = $request->except('_token');
			
			
			
			 $validator = Validator::make($input, [
	            'name' => 'required|max:255',
	            'filter' => 'required|unique:portfolios|max:255'
	        ]);

	        if ($validator->fails()) {
	        	
	            return redirect()->route('portfoliosAdd')
	                        ->withErrors($validator)
	                        ->withInput();
	        }
	        
	        $file = $request->file('images');
	        $request->file('images')->move(public_path().'/assets/img',$file->getClientOriginalName());

	       $input['images'] = $file->getClientOriginalName();
	       
	       
	        $porfolio = new Portfolio();
	       // Page::unguard();
	        $porfolio->fill($input);
	        if($porfolio->save()) {
				return redirect('admin')->with('status', 'Страница добавлена');
			}
		}
		
		if(view()->exists('admin.portfolios_add')) {
			
			$data = [
					
					'title' => 'Новая страница'
					
					];
			return view('admin.portfolios_add',$data);
		}
	}
}
