<?php


namespace ZelFramework\Form\Tests;


use PHPUnit\Framework\TestCase;
use ZelFramework\Form\FormBuilder;
use ZelFramework\Form\Tests\Entity\EntityTests;
use ZelFramework\Form\Type\EmailType;
use ZelFramework\Form\Type\PasswordType;

class FormBuilderTests extends TestCase
{
	
	// php vendor/phpunit/phpunit/phpunit tests/FormBuilderTests.php
	public function testGetForm()
	{
		$formBuilder = new FormBuilder();
		$form = $formBuilder
			->add('email', EmailType::class, ['value' => 'test@test.com'])
			->add('password', PasswordType::class, ['value' => 'pass'])
			->getForm();
		
		$this->assertEquals($form['email']['_type'], EmailType::class);
		$this->assertEquals($form['email']['_options']['value'], 'test@test.com');
		$this->assertEquals($form['password']['_type'], PasswordType::class);
		$this->assertEquals($form['password']['_options']['value'], 'pass');
	}
	
	public function testGetFormWithEntity()
	{
		$entity = new EntityTests();
		$entity->setEmail('test@test.com');
		$entity->setPassword('pass');
		$formBuilder = new FormBuilder($entity);
		$form = $formBuilder
			->add('email', EmailType::class)
			->add('password', PasswordType::class)
			->getForm();
		
		var_dump($form);
		
		$this->assertEquals($form['email']['_type'], EmailType::class);
		$this->assertEquals($form['email']['_options']['value'], 'test@test.com');
		$this->assertEquals($form['password']['_type'], PasswordType::class);
		$this->assertEquals($form['password']['_options']['value'], 'pass');
	}
	
}