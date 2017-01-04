<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\Portfolio;
use App\Service;
use App\Worker;

class IndexController extends Controller
{
    public function index (Request $request) {

		$pages = Page::all();
	    $portfolios = Portfolio::all();
	    $services = Service::all();
	    $workers = Worker::take(3)->get();

	    $menu = [];
	    foreach ($pages as $page) {
		    $item = array('title' => $page->name, 'alias' => $page->alias);
		    array_push($menu, $item);
	    }

	    $item = array('title' => 'Услуги', 'alias' => 'service');
	    array_push($menu, $item);


	    $item = array( 'title' => 'Портфолио', 'alias' => 'Portfolio' );
	    array_push( $menu, $item );

	    $item = array( 'title' => 'Команда', 'alias' => 'team' );
	    array_push( $menu, $item );

	    $item = array( 'title' => 'Контакты', 'alias' => 'contact' );
	    array_push( $menu, $item );

	    return view('site.index', array('menu' => $menu,
		                                'pages' => $pages,
		                                'services' => $services,
		                                'portfolios' => $portfolios,
		                                'workers' => $workers
		                                ));
    }
}
