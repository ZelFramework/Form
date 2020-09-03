<?php


namespace ZelFramework\Form\Twig;


use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class FormTwigExtension extends AbstractExtension
{
	
	public function getFunctions()
	{
		return [
			new TwigFunction('form', [$this, 'form'], ['is_safe' => ['html'], 'needs_environment' => true]),
			new TwigFunction('form_widget', [$this, 'formWidget'], ['is_safe' => ['html'], 'needs_environment' => true]),
			new TwigFunction('form_label', [$this, 'formLabel'], ['is_safe' => ['html'], 'needs_environment' => true]),
			new TwigFunction('form_error', [$this, 'formError'], ['is_safe' => ['html'], 'needs_environment' => true]),
			new TwigFunction('form_help', [$this, 'formHelp'], ['is_safe' => ['html'], 'needs_environment' => true]),
		];
	}
	
	public function form(Environment $environment, $form): string
	{
		$template = $environment->load('src/Views/Twig/bootstrap_4.html.twig');
		
		$render = '';
		
		foreach ($form as $row) {
			$render .= $template->renderBlock('form_row', ['form' => $row]);
		}
		
		return $render;
	}
	
	public function renderBlock(string $blockName, $form, Environment $environment): string
	{
		$template = $environment->load('src/Views/Twig/bootstrap_4.html.twig');
		return $template->renderBlock($blockName, ['form' => $form]);
	}
	
	public function formWidget(Environment $environment, $form): string
	{
		return $this->renderBlock('form_widget', $form, $environment);
	}
	
	public function formLabel(Environment $environment, $form): string
	{
		return $this->renderBlock('form_label', $form, $environment);
	}
	
	public function formError(Environment $environment, $form): string
	{
		return $this->renderBlock('form_error', $form, $environment);
	}
	
	public function formHelp(Environment $environment, $form): string
	{
		return $this->renderBlock('form_help', $form, $environment);
	}
	
	
}