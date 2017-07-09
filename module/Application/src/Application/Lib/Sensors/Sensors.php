<?php

namespace Application\Lib\Sensors;


class Sensors 
{
	
	public static function createSensor($name, $sensorOptions) {
		return new MySensor($name, $sensorOptions);
	}
	
	
	public static function createFromArray(array $array) {
		if(!isset($array["name"])) {
			throw new \Exception("No name given!");
		}
		if(!isset($array["options"])) {
			throw new \Exception("Not options given!");
		}


		$sensor = new MySensor($array["name"], $array["options"]);//self::createSensor($array["name"], $array["options"]);

		if(isset($array["description"])) {
			$sensor->setDescription($array["description"]);
		}
		return $sensor;
	}
	
}