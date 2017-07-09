<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return array(
	'chstavrakis' => array(
		'sensors' => array(
			'sensordht11' => array(
				'active' => true,
				'description'=> 'description here...',
				'options' => array(
					'table_name' => 'sensordht11',
					'order_by' => 'dht_id',
					'order_flow' => 'desc',
					'limit' => 70
				),
				
			),
			'sensor18b20' => array(
				'active' => true,
				'description'=> 'description here...',
				'options' => array(
					'table_name' => 'sensor18b20',
					'order_by' => 'sen_id',
					'order_flow' => 'desc',
					'limit' => 70
				),
			),
			'sensorlight' => array(
				'active' => true,
				'description'=> 'description here...',
				'options' => array(
					'table_name' => 'sensorlight',
					'order_by' => 'sen_id',
					'order_flow' => 'desc',
					'limit' => 70
				),
			),
		),
	),
	'db' => array(
      'driver'         => 'Pdo',
      'dsn'            => 'mysql:dbname=arduino;host=localhost',
      'username'       => 'root',
      'password'	   => '',
   ),
);
