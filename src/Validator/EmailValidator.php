<?php


namespace ZelFramework\Form\Validator;


class EmailValidator implements ValidatorInterface
{
	
	private const PATTERN_EMAIL = '/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/';
	
	/**
	 * {@inheritdoc}
	 */
	public function isValid($value): ?array
	{
		$errors = [];
		
		if ($value === null || $value === '') {
			array_push($errors, 'IS_BLANK');
		}
		
		if (!preg_match(self::PATTERN_EMAIL, $value)) {
			array_push($errors, 'IS_NOT_EMAIL');
		}
		
		return empty($errors) ? null : $errors;
	}
	
}