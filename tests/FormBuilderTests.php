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
	public static function getEntity()
	{
		$entity = new EntityTests();
		$entity->setEmail('test@test.com');
		$entity->setPassword('pass');
		return $entity;
	}
	
	public function testTheme()
	{
		$formBuilder = new FormBuilder();
		$this->assertEquals($formBuilder->getTheme(), null);
		$formBuilder = new FormBuilder([], ['theme' => null]);
		$this->assertEquals($formBuilder->getTheme(), null);
		$formBuilder = new FormBuilder([], ['theme' => 1]);
		$this->assertEquals($formBuilder->getTheme(), 1);
	}
	
	public function testGetForm()
	{
		$formBuilder = new FormBuilder();
		$form = $formBuilder
			->add('email', EmailType::class, ['value' => 'test@test.com'])
			->add('password', PasswordType::class, ['value' => 'pass'])
			->getForm();
		
		$form = $form->createView();
		
		$this->assertEquals($form['email']['_type'], EmailType::class);
		$this->assertEquals($form['email']['_options']['value'], 'test@test.com');
		$this->assertEquals($form['password']['_type'], PasswordType::class);
		$this->assertArrayNotHasKey('value', $form['password']['_options']);
	}
	
	public function testGetFormWithEntity()
	{
		$formBuilder = new FormBuilder(self::getEntity());
		$form = $formBuilder
			->add('email', EmailType::class)
			->add('password', PasswordType::class)
			->getForm();
		
		$form = $form->createView();
		
		$this->assertEquals($form['email']['_type'], EmailType::class);
		$this->assertEquals($form['email']['_options']['value'], 'test@test.com');
		$this->assertEquals($form['password']['_type'], PasswordType::class);
		$this->assertArrayNotHasKey('value', $form['password']['_options']);
	}
	
	public function testRemove()
	{
		$formBuilder = new FormBuilder(self::getEntity());
		$form = $formBuilder
			->remove('password')
			->getForm();
		
		$form = $form->createView();
		
		$this->assertArrayNotHasKey('password', $form);
	}
	
	public function testHandleRequest()
	{
		$entity = new Entity\EntityTests();
		
		$formBuilder = new FormBuilder($entity);
		$form = $formBuilder
			->add('email', EmailType::class)
			->add('password', PasswordType::class)
			->getForm();
		
		$form->handleRequest([
			'email' => 'test@test.com',
			'password' => 'pass',
		]);
		
		$this->assertEquals($entity->getEmail(), 'test@test.com');
		$this->assertEquals($entity->getPassword(), 'pass');
		
		$form = $form->createView();
		
		$this->assertEquals($form['email']['_options']['value'], 'test@test.com');
		$this->assertArrayNotHasKey('value', $form['password']['_options']);
	}
	
}