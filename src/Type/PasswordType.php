<?php


namespace ZelFramework\Form\Type;


class PasswordType
{
	
	/**
	 * {@inheritdoc}
	 */
	public function getType(): string
	{
		return 'password';
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
		return [
			'always_empty' => true,
		];
	}
	
}