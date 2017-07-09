<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class IndexController extends AbstractActionController
{
	private $sensorManager;

	public function __construct(/*$sensorManager,*/ $config, $adapter)
	{
		//$this->sensorManager = $sensorManager;
        $this->config = $config;
        $this->adapter = $adapter;
	}

    public function indexAction()
    {
    	$viewModel = new ViewModel();

    	$sensorsConfig = $this->config['chstavrakis']['sensors'];


        $sensors = null;
        foreach ($sensorsConfig as $key => $value) {
            if($value['active']){
                    $sensors[$key] = $value;

                    $sql = "";
                    $data = [];
                    if(isset($value['options']['table_name'])){

                        $sql .= "SELECT " . $value['options']['order_by'] ." as x FROM ". $value['options']['table_name'];

                        if(isset($value['options']['order_by'])){
                             $sql .= " ORDER BY ". $value['options']['order_by'] . " ";
                        }

                        if(isset($value['options']['order_flow'])){
                            $sql .= strtoupper($value['options']['order_flow']);
                        }

                        if(isset($value['options']['limit'])) {
                            $sql .= " LIMIT ". $value['options']['limit'];
                        }

                        $statement =$this->adapter->query($sql);
                        $result = $statement->execute();
                        $data = $result->getResource()->fetchAll();
                    }
                    $sensors[$key]['data'] = $data;
            }
        }

        $viewModel->sensors = $sensors;

        return $viewModel;
    }
}
