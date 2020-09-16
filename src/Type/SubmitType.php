<?php


namespace ZelFramework\Form\Type;


class SubmitType
{
	
	/**
	 * {@inheritdoc}
	 */
	public function getType(): string
	{
		return 'submit';
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