<?php

class FormBuilder {

	/**
	* Echos the admin form
	*/
	public static function adminForm()
	{	
		$postid = get_the_ID();
		$html = '<table class="widefat"><tbody><tr>';
			$html .= '<td class="ftp-sidebar ftp-padding-20">';
				$html .= self::sidebar($postid);
			$html .= '</td><td class="ftp-form-builder-wrapper ftp-padding-20">';
				$html .= self::builderArea($postid);
			$html .= '</td>';
		$html .= '</tr></tbody></table><div class="ftp-loading"></div>';
		echo $html;
	}

	/**
	* Returns the sidebar form for admin form
	* @param integer $postid
	*/
	public static function sidebar($postid)
	{
		$html = '<div class="ftp-form">';
			$fields = [
				Input::selectAndButton('ftp-new-row-columns', '', 'Number Of Columns', 3, [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5], '', 'ftp-add-row-button', 'Add Row')
			];
			$html .= Input::createSettingsBlock('Add A New Row', '','dashicons-plus-alt', $fields);

			$fields = [
				FieldTypes::getTypeItems()
			];
			$html .= Input::createSettingsBlock('Available Fields', 'Add rows, then drag & drop fields', 'dashicons-plus-alt', $fields);
			$html .= '<a id="ftp-prev-fields" href="#" class="button button-large ftp-left ftp-pagination-button">&larr; Previous</a>';
			$html .= '<a id="ftp-next-fields" href="#" class="button button-large ftp-right ftp-pagination-button">Next &rarr;</a>';
			$html .= '<div class="ftp-clearfix"></div>';
		$html .= '</div>';
		return $html;
	}

	/**
	* Returns html for the form builder
	* @param integer $postid
	*/
	public static function builderArea( $postid )
	{
		$rows = get_post_meta($postid, 'ftp_fields', true);
		$html .= '<div class="ftp-form ftp-form-builder">';
			$html .= '<h2><div class="dashicons dashicons-admin-tools"></div> Form Builder</h2>';
			$html .= '<ul id="ftp-row-list" class="ftp-list">';
			if( !empty($rows) ){
				foreach($rows as $row => $fields){
					$count = count($fields);
					$html .= Row::create( $count, $row, $fields );
				}
			}
		$html .= '</ul></div>';
		return $html;
	}
}