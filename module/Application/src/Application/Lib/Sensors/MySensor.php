<?php

namespace Application\Lib\Sensors;

class MySensor 
{

	private $name;
	private $description;
	private $sensorOptions;
	
	
	public function __construct($name, $sensorOptions) {
	    $this->setName($name);
	    $this->setSensorOptions($sensorOptions);
	}	
	
	public function getName() {
		return $this->name;
	}
	
	public function getDescription() {
		return $this->description;
	}
	
	public function getSensorOptions() {
		return $this->sensorOptions;
	}
	
	public function setName($name) {
		if(empty($name) || !is_string($name)) {
			throw new \Exception("name must be a string and must not be empty!");
		}
		$this->name = $name;
	}
	
	public function setDescription($description) {
		$this->description = $description;
	}
	
	public function setSensorOptions($sensorOptions) {
		if(empty($sensorOptions) || !is_array($sensorOptions)) {
			throw new \Exception("sensorOptions must be array and must not be empty!");
		}
		$this->sensorOptions = $sensorOptions;
	}
}