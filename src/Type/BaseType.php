<?php


namespace ZelFramework\Form\Type;


abstract class BaseType implements TypeInterface
{
	
	private $defaultOptions = [
		'required' => true,
		'disabled' => false,
		'label' => null,
		'attr' => [],
		'row_attr' => [],
		'validate' => false,
		'error' => false,
		'always_empty' => false,
	];
	
	public function buildView(string $name, array $options = [])
	{
		$options = array_replace(
			$this->defaultOptions,
			[
				'id' => $name,
			],
			$options
		);
		
		$options['name'] = $name;
		
		return $options;
	}
	
}