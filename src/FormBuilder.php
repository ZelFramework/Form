<?php


namespace ZelFramework\Form;


use ReflectionFunction;
use SebastianBergmann\Type\ReflectionMapper;
use ZelFramework\Form\Type\SubmitType;
use ZelFramework\Form\Type\PasswordType;
use ZelFramework\Kernel\Configuration;

class FormBuilder
{
	
	private $data;
	/**
	 * @var object
	 */
	private $entity;
	private $options;
	
	/**
	 * FormBuilder constructor.
	 * @param object|array|null $data
	 * @param array $options
	 */
	public function __construct($data = null, array $options = [])
	{
		if (is_object($data)) {
			$this->handleEntity($data);
		} else {
			$this->data = $data;
		}
		
		$this->options = $options;
	}
	
	public function getTheme()
	{
		if (isset($this->options['theme']))
			return $this->options['theme'];
		return class_exists(Configuration::class) ? Configuration::get('config.form.theme', null) : null;
	}
	
	public function handleEntity($entity)
	{
		$this->entity = $entity;
		
		foreach (get_class_methods($this->entity) as $method) {
			if (substr($method, 3, 2) === 'id' || substr($method, -2) === 'id') {
				try {
					$this->data['id'] = $this->entity->$method();;
				} catch (\TypeError $e) {
					$this->data['id'] = null;
				}
			} else if (substr($method, 0, 3) === 'get') {
				$name = substr($method, 3);
				$name[0] = strtolower($name[0]);
				$this->data[$name]['_type'] = null;
				try {
					$this->data[$name]['_options']['value'] = $this->entity->$method();
				} catch (\TypeError $e) {
				}
			}
			
		}
	}
	
	public function add(string $name, string $type = null, array $options = []): self
	{
		if (!isset($options['required']))
			$options['required'] = true;
		
		if (empty($this->data[$name]['_type']))
			$this->data[$name]['_type'] = $type;
		
		if (empty($this->data[$name]['_options']))
			$this->data[$name]['_options'] = $options;
		else
			foreach ($options as $key => $value)
				$this->data[$name]['_options'][$key] = $value;
		
		if (!isset($this->data[$name]['_options']['label']))
			$this->data[$name]['_options']['label'] = $name;
		
		$type = $this->data[$name]['_type'];
		$type = new $type();
		$this->data[$name]['_options']['type'] = $type->getType() ?? 'text';
		
		if (!isset($this->data[$name]['_options']['id']))
			$this->data[$name]['_options']['id'] = $name;
		
		if (!isset($this->data[$name]['_options']['name']))
			$this->data[$name]['_options']['name'] = $name;
		
		return $this;
	}
	
	public function remove(string $name): self
	{
		unset($this->data[$name]);
		
		return $this;
	}
	
	public function getForm()
	{
		return $this;
	}
	
	public function createView()
	{
		$data = $this->data;
		
		$haveInput = false;
		
		foreach ($data as $name => $value) {
			if ($value['_type'] === PasswordType::class)
				unset($data[$name]['_options']['value']);
			elseif ($value['_type'] === SubmitType::class)
				$haveInput = true;
		}
		
		if ($haveInput === false) {
			$data['submit'] = [
				'_type' => SubmitType::class,
				'_options' => [
					'name' => 'submit',
					'type' => 'submit',
				],
			];
		}
		
		return $data;
	}
	
	public function handleRequest($request): void
	{
		foreach ($request as $name => $value) {
			if (isset($this->data[$name])) {
				$this->data[$name]['_options']['value'] = $value;
				
				$name[0] = strtoupper($name[0]);
				$setMethod = 'set' . $name;
				
				foreach (get_class_methods($this->entity) as $method)
					if ($method === $setMethod)
						$this->entity->$method($value);
			}
		}
	}
	
	public function isSubmitted(): bool
	{
		foreach ($this->data as $name => $data) {
			if (!isset($_POST[$name]) && isset($data['_options']['required']) && $data['_options']['required'] === true)
				return false;
		}
		
		return true;
	}
	
	public function isValid(): bool
	{
		// TODO: Verify if the form is valid
		return true;
	}
	
}