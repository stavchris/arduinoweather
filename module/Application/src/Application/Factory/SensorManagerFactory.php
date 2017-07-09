<?php

namespace Application\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Application\Lib\Sensors\SensorManager;
use Application\Lib\Sensors\Sensors;

class SensorManagerFactory implements FactoryInterface
{

	private $config;

	private $serviceLocator;

	public function createService(ServiceLocatorInterface $serviceLocator)
	{

	    $instance = new SensorManager();
	
		$config = $serviceLocator->get("config");


		if(isset($config["chstavrakis"]["sensors"])) {

			$this->configure($instance, $config["chstavrakis"]["sensors"]);
		}
		
		return $instance;
	}
		
	protected function configure(SensorManager $manager, array $configuration) {

		foreach($configuration as $sensorName => $sensorConfig) {

			$isActive = false;
			if(isset($sensorConfig["active"])) {
				$isActive = (bool) $sensorConfig["active"];
				unset($sensorConfig["active"]);
			}
			
			$sensor = Sensors::createFromArray(array_merge(
				$sensorConfig,
				array(
					"name" => $sensorName,
				)
			));
			
			$manager->addSensor($sensor);

			if($isActive) {
				$manager->setActive($sensor);
			}
		}
	}

}