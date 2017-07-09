<?php

namespace Application\Lib\Sensors;


class SensorManager
{

	private $sensors = array();
	private $active = null;


	public function addSensor(Sensor $Sensor) {
		if(!$this->hasSensor($Sensor)) {
			$this->sensors[] = $Sensor;
			return true;
		}
		
		return false;
	}


	public function removeSensor($nameOrInstance) {
		if(!$this->hasSensor($nameOrInstance)) {
			return false;
		}
		
		if(is_string($nameOrInstance)) {
			$nameOrInstance = $this->getSensor($nameOrInstance);
		}
		
		$index = array_search($nameOrInstance, $this->sensors);
		if($index !== false) {
			array_splice($this->sensors, $index, 1);
			return true;
		}
		return false;
	}


	public function setActive($nameOrInstance) {
		if($this->hasSensor($nameOrInstance)) {
			$name = is_string($nameOrInstance) ? $nameOrInstance : $nameOrInstance->getName();
			$this->active = $name;
		} else {
			throw new \Exception("Sensor is not managed by the SensorManager!");
		}
	}


	public function hasSensor($nameOrInstance) {
		if(!is_string($nameOrInstance) && !($nameOrInstance instanceof Sensor)) {
			throw new \Exception("Illegal argument! \$nameOrInstance must either be a string or an instance of Gregblog\sensors\Sensor");
		}
		
		$name = (is_string($nameOrInstance)) ? $nameOrInstance : $nameOrInstance->getName();
		return !is_null($this->getSensor($name));
	}


	public function getSensor($name) {
		if(is_null($name)) {
			return null;
		}
		
		$sensors = $this->getsensors();
		foreach($sensors as $Sensor) {
			if($Sensor->getName() == $name) {
				return $Sensor;
			}
		}
		return null;
	}

	public function getSensors() {
		return $this->sensors;
	}

	public function getActive() {
		return $this->getSensor($this->active);
	}

	public function hasSensors() {
		return !empty($this->getsensors());
	}


}