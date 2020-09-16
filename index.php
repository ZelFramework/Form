<?php

use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;
use ZelFramework\Form\FormBuilder;
use ZelFramework\Form\Tests\Entity\EntityTests;
use ZelFramework\Form\Twig\FormTwigExtension;
use ZelFramework\Form\Type\EmailType;
use ZelFramework\Form\Type\PasswordType;
use ZelFramework\Form\Type\SubmitType;

require 'vendor/autoload.php';

define('PROJECT_DIR', __DIR__ . '/');

$loader = new FilesystemLoader(__DIR__);
$twig = new Environment($loader, [
	'debug' => true,
]);
$twig->addExtension(new DebugExtension());
$twig->addExtension(new FormTwigExtension());

$entity = new EntityTests();

$formBuilder = new FormBuilder($entity);
$form = $formBuilder
	->add('email', EmailType::class)
	->add('password', PasswordType::class)
	->add('Test', SubmitType::class, [
		'row_attr' => [
			'class' => 'ok',
		],
	]);


echo $twig->render('template.html.twig', ['formTest' => $form->createView()]);

