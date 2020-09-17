<?php


namespace ZelFramework\Form\Validator;


interface ValidatorInterface
{
	
	/**
	 * Checks if the passed value is valid.
	 * @param $value mixed
	 * @return array|null
	 */
	public function isValid($value): ?array;
	
}