<?php


namespace ZelFramework\Form;


use ReflectionFunction;
use SebastianBergmann\Type\ReflectionMapper;
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
		return class_exists(Configuration::class) ? Configuration::get('config.form.theme', null) : null;
	}
	
	public function handleEntity($entity)
	{
		$this->entity = $entity;
		
		foreach (get_class_methods($this->entity) as $method) {
			if (substr($method, 0, 3) === 'get') {
				$name = substr($method, 3);
				$name[0] = strtolower($name[0]);
				$this->data[$name]['_type'] = null;
				try {
					$this->data[$name]['_options']['value'] = $this->entity->$method();
					var_dump($this->entity->$method());
				} catch (\TypeError $e) {
					var_dump($name . 'null');
				}
			}
			
		}
	}
	
	public function add(string $name, string $type = null, array $options = []): self
	{
		if (!isset($options['required']))
			$options['required'] = true;
		
		if ($this->data[$name]['_type'] === null)
			$this->data[$name]['_type'] = $type;
		
		if (empty($this->data[$name]['_options']))
			$this->data[$name]['_options'] = $options;
		else
			foreach ($options as $key => $value)
				$this->data[$name]['_options'][$key] = $value;
		
		return $this;
	}
	
	public function remove(string $name): self
	{
		unset($this->data[$name]);
		
		return $this;
	}
	
	public function getForm()
	{
		return $this->data;
	}
	
	public function handleRequest($request): void
	{
		foreach ($request as $name => $value) {
			if ($name[0] === '_') {
				$setMethod = 'set' . substr($name, 1);
				if ($name !== '_password')
					foreach (get_class_methods($this->entity) as $method)
						if ($method === $setMethod)
							$this->entity->$method($value);
			} else {
				if ($this->data[$name]['_type'] !== PasswordType::class)
					$this->data[$name] = $value;
			}
		}
	}
	
}