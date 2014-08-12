<?php

class FormBuilder {

	private $_postid,
			$_rows;

	/**
	* Sets the id, rows, and returns get
	* @return get()
	*/
	public function __construct()
	{
		$this->_postid = get_the_ID();
		$this->setRows();
		return $this->get();
	}

	/**
	* Sets the rows
	*/
	private function setRows()
	{
		$this->_rows = get_post_meta($this->_postid, 'ftp_fields', true);
		return;
	}

	/**
	* Echos the form builder
	*/
	private function get()
	{	
		$html = '<table class="widefat"><tbody><tr>';
			$html .= '<td class="ftp-sidebar ftp-padding-20">';
				$html .= $this->sidebar();
			$html .= '</td><td class="ftp-form-builder-wrapper ftp-padding-20">';
				$html .= $this->builderArea();
			$html .= '</td>';
		$html .= '</tr></tbody></table><div class="ftp-loading"></div>';
		echo $html;
	}

	/**
	* Returns the sidebar form for admin form
	*/
	private function sidebar()
	{
		$html = '<div class="ftp-form">';
			$fields = [
				Input::selectAndButton('ftp-new-row-columns', '', 'Number Of Columns', 3, [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5], '', 'ftp-add-row-button', 'Add Row')
			];
			$html .= Input::createSettingsBlock('Add A New Row', '','dashicons-plus-alt', $fields);

			/* Tabs Go Here */
			$html .= '<a id="post" href="#" class="button button-large ftp-pagination-button">Post Fields</a>';
			$html .= '<a id="basic" href="#" class="button button-large ftp-pagination-button">Basic Fields</a>';
			$html .= '<a id="advanced" href="#" class="button button-large ftp-pagination-button">Advanced Fields</a>';

			$fields = [
				FieldTypes::getTypeItems()
			];
			$html .= Input::createSettingsBlock('Available Fields', 'Add rows, then drag & drop fields', 'dashicons-plus-alt', $fields, 'ftp-field-types');
			$html .= '<div class="ftp-clearfix"></div>';
		$html .= '</div>';
		return $html;
	}

	/**
	* Returns html for the form builder
	*/
	private function builderArea()
	{
		$html .= '<div class="ftp-form ftp-form-builder">';
			$html .= '<h2><div class="dashicons dashicons-admin-tools"></div> Form Builder</h2>';
			$html .= '<ul id="ftp-row-list" class="ftp-list">';
			if( !empty($this->_rows) ){
				foreach($this->_rows as $row => $fields){
					$count = count($fields);
					$html .= Row::create( $count, $row, $fields );
				}
			}
		$html .= '</ul></div>';
		return $html;
	}
}