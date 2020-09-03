<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use ZelFramework\Form\Twig\FormTwigExtension;

require 'vendor/autoload.php';

define('PROJECT_DIR', __DIR__ . '/');

$loader = new FilesystemLoader(__DIR__);
$twig = new Environment($loader);
$twig->addExtension(new FormTwigExtension());
echo $twig->render('template.html.twig', ['formTest' => []]);

