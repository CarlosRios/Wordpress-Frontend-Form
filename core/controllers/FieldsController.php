<?php

use WPFF\View;
use Colony\Form;

class FieldsController {

	public function create( $type )
	{
		echo View::make( 'admin.builder.fieldPlaceholder' )->with( 'type', $type );
	}

}