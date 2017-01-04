<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\Portfolio;
use App\Service;
use App\Worker;
use DB;
use Mail;

class IndexController extends Controller {
	public function index( Request $request ) {

		if ( $request->isMethod( 'post' ) ) {

			$messages = [
				'requires' => 'Поле :attribute обязательно к заполнению',
				'email'    => 'Поле :attribute должно соответствовать  email адресу'
			];

			$this->validate( $request, [

				'name'  => 'required|max:255',
				'email' => 'required|email',
				'text'  => 'required'

			], $messages );
		}


		$result = Mail::send( 'site.email', [ 'request' => $request ], function ( $message ) use ( $request ) {

			$mail_admin = env( 'MAIL_ADMIN' );

			$message->from( $request->email, $request->name );
			$message->to( $mail_admin, 'Ув. админ' )->subject( 'Вопрос' );


		} );

		if ( $result ) {
			return redirect()->route( 'home' )->with( 'status', 'Отправлено!' );;
		}


		$pages      = Page::all();
		$portfolios = Portfolio::all();
		$services   = Service::all();
		$workers    = Worker::take( 3 )->get();

		$tags = DB::table( 'portfolios' )->distinct()->pluck( 'filter' );

		$menu = [];
		foreach ( $pages as $page ) {
			$item = array( 'title' => $page->name, 'alias' => $page->alias );
			array_push( $menu, $item );
		}

		$item = array( 'title' => 'Услуги', 'alias' => 'service' );
		array_push( $menu, $item );


		$item = array( 'title' => 'Портфолио', 'alias' => 'Portfolio' );
		array_push( $menu, $item );

		$item = array( 'title' => 'Команда', 'alias' => 'team' );
		array_push( $menu, $item );

		$item = array( 'title' => 'Контакты', 'alias' => 'contact' );
		array_push( $menu, $item );

		return view( 'site.index', array(
			'menu'       => $menu,
			'pages'      => $pages,
			'services'   => $services,
			'portfolios' => $portfolios,
			'workers'    => $workers,
			'tags'       => $tags,
		) );
	}
}
