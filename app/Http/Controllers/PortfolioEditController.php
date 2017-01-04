<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\PagesRequest;
use Validator;
use App\Portfolio;

class PortfolioEditController extends Controller {
	public function index( Request $request, $id ) {

		$portfolio = Portfolio::find($id);

		if ( ! $portfolio ) {
			return redirect( 'admin' );
		}

		if ( $request->isMethod( 'delete' ) ) {
			$portfolio->delete();

			return redirect( 'admin' )->with( 'status', 'Портфолио удалено' );
		}


		if ( $request->isMethod( 'post' ) ) {

			$input = $request->except( '_token' );


			$validator = Validator::make( $input, [
				'name'   => 'required|max:255',
				'filter' => 'required|max:255'
			] );

			if ( $validator->fails() ) {

				return redirect()->route( 'portfolioEdit', [ 'portfolio' => $input['id'] ] )
				                 ->withErrors( $validator );
			}

			if ( $request->hasFile( 'img' ) ) {
				//
				$file = $request->file( 'img' );
				$request->file( 'img' )->move( public_path() . '/assets/img', $file->getClientOriginalName() );

				$input['img'] = $file->getClientOriginalName();
			} else {
				$input['img'] = $input['old_img'];
			}

			unset( $input['old_img'] );

			$portfolio->fill( $input );
			if ( $portfolio->update() ) {
				return redirect( 'admin' )->with( 'status', 'Страница обновлена' );
			}
		}


		if ( view()->exists( 'admin.portfolio_edit' ) ) {

			$data = [

				'title' => 'Редактирование страницы  "' . $portfolio['name'] . '""',
				'data' => $portfolio,
			];

			return view( 'admin.portfolio_edit', $data );
		}
	}
}
