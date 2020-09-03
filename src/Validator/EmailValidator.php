<?php


namespace ZelFramework\Form\Validator;


class EmailValidator implements  ValidatorInterface
{
	
	private const PATTERN_EMAIL = '/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/';
	
	/**
	 * {@inheritdoc}
	 */
	public function isValid($var): bool
	{
		
		return true;
	}
}