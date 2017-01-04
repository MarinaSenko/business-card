<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use Validator;

class PagesEditController extends Controller {
// add dependencies - model
	public function index( Request $request, $id ) {


		$page = Page::find( $id );

		if ( $request->isMethod( 'delete' ) ) {
			$page->delete();

			return redirect( 'admin' )->with( 'status', 'Страница удалена' );
		}


		if ( $request->isMethod( 'post' ) ) {

			$input = $request->except( '_token' );

			$validator = Validator::make( $input, [

				'text'  => 'required',
				'name'  => 'required|max:255',
				'alias' => 'required|max:255|unique:pages,alias,  ' . $input['id'],

			] );

			if ( $validator->fails() ) {
				return redirect()->route( 'pagesEdit', [ 'page' => $input['id'] ] )->withErrors( $validator );
			}

			if ( $request->hasFile( 'img' ) ) {
				$file = $request->file( 'img' );
				$file->move( public_path() . '/assets/img', $file->getClientOriginalName() );
				$input['img'] = $file->getClientOriginalName();
			} else {

				$input['img'] = $input['old_img'];
			}

			unset( $input['old_img'] );

			$page->fill( $input );

			if ( $page->update() ) {
				return redirect( 'admin' )->with( 'status', 'Страница обновлена' );
			}

		}

		if ( view()->exists( 'admin.pages_edit' ) ) {

			$data = [
				'title' => 'Редактирование страницы  "' . $page['name'] . '""',
				'data'  => $page,
			];

			return view( 'admin.pages_edit', $data );

		}


		abort( 404 );

	}
}
