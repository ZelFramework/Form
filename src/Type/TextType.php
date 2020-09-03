<?php


namespace ZelFramework\Form\Type;


class TextType implements TypeInterface
{
	
	/**
	 * {@inheritdoc}
	 */
	public function getType(): string
	{
		return 'text';
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function getParent(): ?string
	{
		return null;
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function configureOption(): array
	{
		return [];
	}
	
}