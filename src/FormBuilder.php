<?php


namespace ZelFramework\Form;


class FormBuilder
{
	
	private $data;
	private $options;
	
	
	/**
	 * FormBuilder constructor.
	 * @param object|array|null $data
	 * @param array $options
	 */
	public function __construct($data = null, array $options = [])
	{
		$this->data = $data;
		$this->options = $options;
	}
	
	
}