<?php


namespace ZelFramework\Form\Validator;


interface ValidatorInterface
{
	
	/**
	 * Check if the variable is of the same type as the class used
	 * @param $var mixed
	 * @return bool
	 */
	public function isValid($var): bool;
	
}