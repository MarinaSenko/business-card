<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Portfolio;

class PortfolioController extends Controller
{
    //

	public function index () {
		    if ( view()->exists( 'admin.portfolio' ) ) {
			    $portfolios = Portfolio::all();

			    return view( 'admin.portfolio')->with(['portfolios' => $portfolios, 'title' => 'Портфолио' ]);
		    }

		    abort(404);
	    }
}
