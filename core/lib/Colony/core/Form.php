<?php
namespace Colony;

class Form {

	/**
	 * The HTML builder instance.
	 *
	 * @var Colony\HtmlBuilder
	 */
	protected $html;

	/**
	 * Instantiate the Html Builder
	 */
	public function __construct()
	{
		$this->html = new HtmlBuilder;
	}

	/**
	 * Create a form label element.
	 *
	 * @param  string  $name
	 * @param  string  $value
	 * @param  array   $options
	 * @return string
	 */
	public function label($name, $value = null, $options = array())
	{
		$this->labels[] = $name;

		$options = $this->html->attributes($options);

		$value = e($this->formatLabel($name, $value));

		return '<label for="'.$name.'"'.$options.'>'.$value.'</label>';
	}

	/**
	 * Format the label value.
	 *
	 * @param  string  $name
	 * @param  string|null  $value
	 * @return string
	 */
	protected function formatLabel($name, $value)
	{
		return $value ?: ucwords(str_replace('_', ' ', $name));
	}

	/**
	 * Generates an input field
	 * @param  string $type
	 * @param  string $name
	 * @param  mixed $value
	 * @param  array  $options
	 * @return input
	 */
	public function input( $type, $name, $value = null, $options = array() )
	{
		if ( ! isset($options['name'])) $options['name'] = $name;
		$merge = compact( 'type', 'name', 'value' );
		$options = array_merge($options, $merge);
		return '<input'.$this->html->attributes($options).'>';
	}

	/**
	 * Create a text input field.
	 *
	 * @param  string  $name
	 * @param  string  $value
	 * @param  array   $options
	 * @return string
	 */
	public function text($name, $value = null, $options = array())
	{
		return $this->input('text', $name, $value, $options);
	}

	/**
	 * Create a password input field.
	 *
	 * @param  string  $name
	 * @param  array   $options
	 * @return string
	 */
	public function password($name, $options = array())
	{
		return $this->input('password', $name, '', $options);
	}

	/**
	 * Create a hidden input field.
	 *
	 * @param  string  $name
	 * @param  string  $value
	 * @param  array   $options
	 * @return string
	 */
	public function hidden($name, $value = null, $options = array())
	{
		return $this->input('hidden', $name, $value, $options);
	}

	/**
	 * Create an e-mail input field.
	 *
	 * @param  string  $name
	 * @param  string  $value
	 * @param  array   $options
	 * @return string
	 */
	public function email($name, $value = null, $options = array())
	{
		return $this->input('email', $name, $value, $options);
	}

	/**
	 * Create a url input field.
	 *
	 * @param  string  $name
	 * @param  string  $value
	 * @param  array   $options
	 * @return string
	 */
	public function url($name, $value = null, $options = array())
	{
		return $this->input('url', $name, $value, $options);
	}

	/**
	 * Create a file input field.
	 *
	 * @param  string  $name
	 * @param  array   $options
	 * @return string
	 */
	public function file($name, $options = array())
	{
		return $this->input('file', $name, null, $options);
	}

	/**
	 * Create a textarea input field.
	 *
	 * @param  string  $name
	 * @param  string  $value
	 * @param  array   $options
	 * @return string
	 */
	public function textarea($name, $value = null, $options = array())
	{
		if ( ! isset($options['name']) ) $options['name'] = $name;

		// Set reasonable defaults for rows and cols
		if( !isset($options['rows']) ) $options['rows'] = 10;
		if( !isset($options['cols']) ) $options['cols'] = 50;

		// Next we will convert the attributes into a string form. Also we have removed
		// the size attribute, as it was merely a short-cut for the rows and cols on
		// the element. Then we'll create the final textarea elements HTML for us.
		$options = $this->html->attributes($options);

		return '<textarea'.$options.'>'.e($value).'</textarea>';
	}

	/**
	 * Create a number input field.
	 *
	 * @param  string  $name
	 * @param  array   $options
	 * @return string
	 */
	public function number($name, $value = null, $options = array())
	{
		return $this->input('number', $name, $value, $options);
	}

	/**
	 * Create a select box field.
	 *
	 * @param  string  $name
	 * @param  array   $list
	 * @param  string  $selected
	 * @param  array   $options
	 * @return string
	 */
	public function select($name, $list = array(), $selected = null, $options = array())
	{
		if ( ! isset($options['name'])) $options['name'] = $name;

		// We will simply loop through the options and build an HTML value for each of
		// them until we have an array of HTML declarations. Then we will join them
		// all together into one single HTML element that can be put on the form.
		$html = array();

		foreach ($list as $value => $display)
		{
			$html[] = $this->getSelectOption($display, $value, $selected);
		}

		// Once we have all of this HTML, we can join this into a single element after
		// formatting the attributes into an HTML "attributes" string, then we will
		// build out a final select statement, which will contain all the values.
		$options = $this->html->attributes($options);

		$list = implode('', $html);

		return "<select{$options}>{$list}</select>";
	}

	/**
	 * Create a select range field.
	 *
	 * @param  string  $name
	 * @param  string  $begin
	 * @param  string  $end
	 * @param  string  $selected
	 * @param  array   $options
	 * @return string
	 */
	public function selectRange($name, $begin, $end, $selected = null, $options = array())
	{
		$range = array_combine($range = range($begin, $end), $range);

		return $this->select($name, $range, $selected, $options);
	}

	/**
	 * Create a select year field.
	 *
	 * @param  string  $name
	 * @param  string  $begin
	 * @param  string  $end
	 * @param  string  $selected
	 * @param  array   $options
	 * @return string
	 */
	public function selectYear()
	{
		return call_user_func_array(array($this, 'selectRange'), func_get_args());
	}

	/**
	 * Create a select month field.
	 *
	 * @param  string  $name
	 * @param  string  $selected
	 * @param  array   $options
	 * @param  string  $format
	 * @return string
	 */
	public function selectMonth($name, $selected = null, $options = array(), $format = '%B')
	{
		$months = array();

		foreach (range(1, 12) as $month)
		{
			$months[$month] = strftime($format, mktime(0, 0, 0, $month, 1));
		}

		return $this->select($name, $months, $selected, $options);
	}

	/**
	 * Get the select option for the given value.
	 *
	 * @param  string  $display
	 * @param  string  $value
	 * @param  string  $selected
	 * @return string
	 */
	public function getSelectOption($display, $value, $selected)
	{
		if (is_array($display))
		{
			return $this->optionGroup($display, $value, $selected);
		}

		return $this->option($display, $value, $selected);
	}

	/**
	 * Create an option group form element.
	 *
	 * @param  array   $list
	 * @param  string  $label
	 * @param  string  $selected
	 * @return string
	 */
	protected function optionGroup($list, $label, $selected)
	{
		$html = array();

		foreach ($list as $value => $display)
		{
			$html[] = $this->option($display, $value, $selected);
		}

		return '<optgroup label="'.e($label).'">'.implode('', $html).'</optgroup>';
	}

	/**
	 * Create a select element option.
	 *
	 * @param  string  $display
	 * @param  string  $value
	 * @param  string  $selected
	 * @return string
	 */
	protected function option($display, $value, $selected)
	{
		$selected = $this->getSelectedValue($value, $selected);

		$options = array('value' => e($value), 'selected' => $selected);

		return '<option'.$this->html->attributes($options).'>'.e($display).'</option>';
	}

	/**
	 * Determine if the value is selected.
	 *
	 * @param  string  $value
	 * @param  string  $selected
	 * @return string
	 */
	protected function getSelectedValue($value, $selected)
	{
		if (is_array($selected))
		{
			return in_array($value, $selected) ? 'selected' : null;
		}
		return ((string) $value == (string) $selected) ? 'selected' : null;
	}	

	/**
	 * Create a checkbox input field.
	 *
	 * @param  string  $name
	 * @param  mixed   $value
	 * @param  bool    $checked
	 * @param  array   $options
	 * @return string
	 */
	public function checkbox($name, $value = 1, $checked = false, $options = array())
	{
		return $this->checkable('checkbox', $name, $value, $checked, $options);
	}

	/**
	 * Create a radio button input field.
	 *
	 * @param  string  $name
	 * @param  mixed   $value
	 * @param  bool    $checked
	 * @param  array   $options
	 * @return string
	 */
	public function radio($name, $value = null, $checked = false, $options = array())
	{
		if (is_null($value)) $value = $name;
		return $this->checkable('radio', $name, $value, $checked, $options);
	}

	/**
	 * Create a checkable input field.
	 *
	 * @param  string  $type
	 * @param  string  $name
	 * @param  mixed   $value
	 * @param  bool    $checked
	 * @param  array   $options
	 * @return string
	 */
	protected function checkable($type, $name, $value, $checked = false, $options)
	{
		if ($checked) $options['checked'] = 'checked';
		return $this->input($type, $name, $value, $options);
	}

}