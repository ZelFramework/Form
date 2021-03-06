<?php


namespace ZelFramework\Form\Type;


class EmailType
{
	
	/**
	 * {@inheritdoc}
	 */
	public function getType(): string
	{
		return 'email';
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function getParent(): ?string
	{
		return TextType::class;
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function configureOption(): array
	{
		return [];
	}
	
}