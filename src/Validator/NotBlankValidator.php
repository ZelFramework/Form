<?php


namespace ZelFramework\Form\Validator;


class NotBlankValidator implements ValidatorInterface
{
	
	/**
	 * @inheritDoc
	 */
	public function isValid($value): ?array
	{
		$errors = [];
		
		if ($value === null || $value === '') {
			array_push($errors, 'IS_BLANK');
		}
		
		return empty($errors) ? null : $errors;
	}
	
}