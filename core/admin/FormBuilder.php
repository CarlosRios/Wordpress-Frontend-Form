<?php
namespace WPFF\Admin;

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
		echo $this->get();
	}

	/**
	* Sets the rows
	*/
	private function setRows()
	{
		$this->_rows = get_post_meta($this->_postid, 'wpff_fields', true);
		return;
	}

	/**
	* Echos the form builder
	*/
	private function get()
	{	
		$html = '<table class="widefat"><tbody><tr>';
			$html .= '<td class="wpff-sidebar wpff-padding-20">';
				$html .= $this->sidebar();
			$html .= '</td><td class="wpff-form-builder-wrapper wpff-padding-20">';
				$html .= $this->builderArea();
			$html .= '</td>';
		$html .= '</tr></tbody></table><div class="wpff-loading"></div>';
		return $html;
	}

	/**
	* Returns the sidebar form for admin form
	*/
	private function sidebar()
	{
		$html = '<div class="wpff-form">';
			$fields = [
				Input::selectAndButton('wpff-new-row-columns', '', 'Number Of Columns', 3, [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5], '', 'wpff-add-row-button', 'Add Row')
			];
			$html .= Input::createSettingsBlock('Add A New Row', '','dashicons-plus-alt', $fields);

			$fields = [
				FieldTypes::getTypeItems()
			];

			$extra = '<div id="wpff-pagination-tab-container">';
			$extra .= '<a id="post" href="#" class="wpff-pagination-tab wpff-active-tab">Post</a>';
			$extra .= '<a id="basic" href="#" class="wpff-pagination-tab">Basic</a>';
			$extra .= '<a id="advanced" href="#" class="wpff-pagination-tab wpff-pagination-tab-last">Advanced</a>';
			$extra .= '</div>';

			$html .= Input::createSettingsBlock('Available Fields', 'Add rows, then drag & drop fields', 'dashicons-plus-alt', $fields, 'wpff-field-types', $extra);
			$html .= '<div class="wpff-clearfix"></div>';
		$html .= '</div>';
		return $html;
	}

	/**
	* Returns html for the form builder
	*/
	private function builderArea()
	{
		$html .= '<div class="wpff-form wpff-form-builder">';
			$html .= '<h2><div class="dashicons dashicons-admin-tools"></div> Form Builder</h2>';
			$html .= '<ul id="wpff-row-list" class="wpff-list">';
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