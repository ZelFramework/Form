<?php


namespace ZelFramework\Form\Type;


interface TypeInterface
{
	
	/**
	 * Returns the type
	 *
	 * @return string
	 */
	public function getType(): string;
	
	/**
	 * Returns the name of the parent type
	 *
	 * @return string|null
	 */
	public function getParent(): ?string;
	
	/**
	 * Configuration the form options for this type
	 *
	 * @param array $options
	 */
	public function configureOptions(array $options = []);
	
}